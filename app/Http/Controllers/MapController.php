<?php

namespace App\Http\Controllers;

use App\Category;
use App\Frequency;
use App\MaintenanceRating;
use App\Schedule;
use App\Task;
use Carbon\Carbon;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;

use App\Point;
use Illuminate\Support\Facades\Log;

use function Psy\debug;

class MapController extends Controller
{

    protected $gmap;

    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
        //$this->middleware('auth')->except('index');

    }

    public function index(){

        /******** Custom Map Controls ********/
        $Controls = ['document.getElementById("custom-controls")'];
        $this->gmap->injectControlsInBottomCenter = $Controls;


        /******** End Controls ********/


        /******** Custom Map Configuration ********/
        $config = array();
        $config['map_height'] = "100%";
        $config['zoom'] = '14';
        //Allow users to add markers
        $config['drawing'] = true;
        $config['drawingModes'] = array('marker');
        $config['drawingDefaultMode'] = 'null';
        $config['drawingControl'] = false;
        $config['drawingOnComplete'] = array('marker'=>'
                newShape.setMap(null);
                $("#modal-input-edit-marker-lat").val(newShape.getPosition().lat());
                $("#modal-input-edit-marker-lng").val(newShape.getPosition().lng());
                $("#editMarker").modal("show");
            ');
        $config['center'] = '44.655694,-63.734611';
        //$config['center'] = 'auto';
        $config['kmlLayerURL'] = 'https://blttrails.ca/BLTMap.kml'; //Base Map of Trail
        $config['map_type'] = 'SATELLITE';
        $config['disableStreetViewControl'] = true;
        $config['zoomControlPosition'] = 'RIGHT_CENTER';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        //events that would be triggered to early by OnLoadCompleted need to be added here.
        $this->gmap->onload = "onMapLoadComplete();";

        $pointsOfInterest = (new Point)->getAllPointsByType();
        foreach($pointsOfInterest as $POI) {
            $this->gmap->add_marker($this->addMapPointsPropertiesToMarker($POI));
        }
        $map = $this->gmap->create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']

        /******** END Custom Map Configuration ********/

        $categoryTypes = (new Category())->getAllCategoryTypes();
        $categories = (new Category())->getAllCategoriesAndId();
        $frequencies  = (new Frequency())->getAllFrequenciesAndId();
        $maintenance_ratings = (new MaintenanceRating())->getAllAsArray();

        return view('map', compact(['map','categoryTypes', 'frequencies', 'categories', 'maintenance_ratings']));
    }



    private function addMapPointsPropertiesToMarker($POI) {
        $marker = array();
        $marker['position']= $POI->lat . ',' . $POI->lng;
        $marker['infowindow_content'] = $this->generateInfoWindowFromPoint($POI);
        $marker['cursor'] = $POI->title;
        $marker['icon'] = $POI->icon ?: $POI->category->default_icon;
        $marker['title'] = $POI->title;
        return $marker;
    }

    private function generateInfoWindowFromPoint($POI) {
        $html = $this->generateInfoWindowTop($POI);
        $html .= "        <a class=\"dropdown-item editMarker\" href=\"#\" point-id='". $POI->id ."'>Edit Marker</a>";
        if(auth()->check()) {
            $html .= "        <a class=\"dropdown-item editMarkerSchedule\" href=\"#\" point-id='". $POI->id ."'>Manage Schedule</a>";
            $html .= "        <a class=\"dropdown-item\" href=\"#\" point-id='". $POI->id ."'>todo Report Condition</a>";
            $html .= "        <a class=\"dropdown-item\" href=\"#\" point-id='". $POI->id ."'>todo Hide This Type</a>";
            $html .= "        <a class=\"dropdown-item\" href=\"#\" point-id='". $POI->id ."'>todo Rate</a>";
        }
        $html .= $this->generateInfoWindowBottom($POI);
        return $html;
    }

    private function generateInfoWindowFromTask($task) {
        $html = $this->generateInfoWindowTop($task);
        $html .= "        <a class=\"dropdown-item taskMarkCompleted\" href=\"#\" task-id='". $task->tasks_id ."'>Mark Completed</a>";
        if(auth()->check()) {
            $html .= "        <a class=\"dropdown-item\" href=\"#\" task-id='". $task->tasks_id ."'>todo Assign</a>";
            $html .= "        <a class=\"dropdown-item\" href=\"#\" task-id='". $task->tasks_id ."'>todo Delegate</a>";
            $html .= "        <a class=\"dropdown-item\" href=\"#\" task-id='". $task->tasks_id ."'>todo Report Condition</a>";
        }
        $html .= $this->generateInfoWindowBottom($task);
        return $html;
    }

    private function generateInfoWindowFromMaintenanceItem($point) {
        $html = $this->generateInfoWindowTop($point);
        $html .= "        <a class=\"dropdown-item maintenanceMarkCompleted\" href=\"#\" point-id='". $point->id ."'>Mark Completed</a>";
        if(auth()->check()) {
            $html .= "        <a class=\"dropdown-item\" href=\"#\" point-id='". $point->id ."'>todo Assign</a>";
            $html .= "        <a class=\"dropdown-item\" href=\"#\" point-id='". $point->id ."'>todo Delegate</a>";
            $html .= "        <a class=\"dropdown-item\" href=\"#\" point-id='". $point->id ."'>todo Report Condition</a>";
        }
        $html .= $this->generateInfoWindowBottom($point);
        return $html;
    }

    private function generateInfoWindowTop($point) {
        $html = "<div class=\"card\" style=\"width:302px\">";
        if($point->image) {
            $html .= "<img class=\"card-img-top card-image-map\" src=\"" . url(env('PATH_TO_IMAGES_MAP_CARD') ). '/' . $point->image ."\" alt=\"Card image\">";
        }

        $html .= "<div class=\"card-body\">";
        $html .= "<h4 class=\"card-title\">" . $point->title . "</h4>";        
        $html .= "<p class=\"card-text\">" ;
        if($point->hasMaintenanceRating()) {
            $html .= $point->maintenanceRating->name . "<br>" ;
        }
        $html .= $point->description;
        $html .= "</p>";
        $html .= "<button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Options</button>";
        $html .= "    <div class=\"dropdown-menu\">";

        return $html;
    }

    private function generateInfoWindowBottom($point){
        $html = "    </div>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }






    public function saveEditMarker(Request $request) {
        request()->validate([
            'lat' => 'required',
            'lng' => 'required',
            'title' => 'required',
            'categories_id' => 'required',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:15000'
        ]);

        if(request()->input('delete') == 'delete') {
            return Point::destroy(request()->input('id'));
        }

        $newMarker = $request->all();

        if($request->has('image')) {
            $imageName = (new \App\Category)->getCategoryNameByID($newMarker['categories_id']) . '-' . $newMarker['title'] . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path(env('PATH_TO_IMAGES')), $imageName);

            $newMarker['image'] = $imageName;
        }
        if($newMarker['maintenance_rating'] == '-1') {
            $newMarker['maintenance_rating'] = null;
        }

        $POI = Point::updateOrCreate(['id' => $request->input('id')], $newMarker);
        $POI->resizeImageForMapCard();
        $POI['icon'] = (new \App\Category)->getDefaultIconByID($POI['categories_id']);
        $POI['description'] = $this->generateInfoWindowFromPoint($POI);
        //todo: trigger schedule generation for new POI
        (new \App\ArchiveImage())->add($POI->image, $POI->id, $this->getIp(), auth()->id() );
        return  response()->json($POI);
    }


    public function saveSchedule(Request $request) {
        request()->validate([
            'frequency_id' => 'required',
            'start_date' => 'required|date',
            'title' => 'required',
            'description' => 'required',
            'future_events_to_generate' => 'required',
            'cascade_future_tasks_on_completion' => 'required',
            'reward_points' => 'required',
            'action' => 'required'
        ]);
        if($request->input('points_id') || $request->input('categories_id')) {
            $schedule = Schedule::updateOrCreate(['id' => $request->input('id')], $request->all());
            if($request->input('points_id') ) {
                $response = "Override Schedule For " . (new Point)->find($request->input('points_id'))->title . " Updated.";
            } else {
                $response = "Default Schedule Updated For " . $schedule->category->name;
            }
            return  response()->json($response);
        }
        return response()->json("Unable to identify points to apply schedule to.  Reload page and try again");
    }


    public function GetAllTasksInDateRangeJSON(Request $request) {
        //todo: only return 1st of series (distinct on points_id and type of task) - Min Date.
        $taskCollection = Task::select('tasks.id as tasks_id', 'tasks.*', 'points.*', 'categories.*')->join('points','tasks.points_id','=', 'points.id')->join('categories','points.categories_id', '=','categories.id')->whereNotIn('status',['Cancelled', 'Completed'])->where('estimated_date','<=', carbon::now()->addDays($request->input('daysToLookAhead')))->get();
        $maintenanceCollection = (new \App\Point)->with('category')->where('type', '=', 'Maintenance')->get();
        $maintenanceCollection = $maintenanceCollection->map(function($task) {
            $task['description'] = $this->generateInfoWindowFromMaintenanceItem($task);
            return $task;
        });

        $taskCollection = $taskCollection->map(function($task) {
            $task['description'] = $this->generateInfoWindowFromTask($task);
            return $task;
        });

        $taskCollection = $taskCollection->concat($maintenanceCollection);
//need lat, lng, title, description, icon, default_icon,
        return response()->json($taskCollection);

    }

    public function getMarkerByIDJSON(Request $request) {
        return response()->json(Point::where('id', $request->input('id'))->first());
    }

    public function GetPointsByTypeJSON(Request $request) {
        $POIs = (new Point)->getAllPointsByType($request->input('category_type'));
        foreach($POIs as $id => $POI) {
            $POIs[$id]->description = $this->generateInfoWindowFromPoint(($POI));
        }
        return response()->json($POIs);
    }

    public function getCategoriesByTypesJSON(Request $request) {
        return response()->json((new Category)->getCategoriesAndIdByType($request->input('type')));

    }

    public function getScheduleByCategoryIDJSON(Request $request) {
        return response()->json((new Schedule)::where('categories_id',$request->input('categories_id'))->first());
    }

    public function getScheduleByPointIDJSON(Request $request) {
        $schedule = (new Schedule)::where('points_id',$request->input('point_id'))->first();
        if(!$schedule) {
            $category_id = (new Point)->find($request->input('point_id'))->categories_id;
            $schedule = (new Schedule)::where('categories_id',$category_id)->first();
            $schedule->id = '';
        }
        return response()->json($schedule);
    }



    public function getCategoryByCategoryIDJSON(Request $request) {
        return response()->json((new Category)::where('id',$request->input('categories_id'))->first());
    }


    public function saveCategory(Request $request) {
        request()->validate([
            'type' => 'required',
            'name' => 'required',
            'default_icon' => 'required'
        ]);
        $category = Category::updateOrCreate(['id' => $request->input('id')], $request->all());
        $response = $category->type . ' / ' . $category->name . " successfully updated";
        return  response()->json($response);
    }

    public function executeVerifyTasks() {
        (new Task)->CreateAllTasksFromSchedules();
        return "All Tasks Verified";
    }

    public function executeVerifyPictures() {
        (new Point)->verifyAllImagesResizedForMapCard();
        return "All Pictures Verified";
    }

    public function executeMarkTaskComplete(Request $request) {
        request()->validate([
            'taskId' => 'required'
        ]);
        $task = (new \App\Task)->find($request->input('taskId'));
        $task->status = 'Completed';
        $task->save();
        return('Task marked as completed');
    }

    public function executeMarkMaintenanceComplete(Request $request) {
        request()->validate([
            'pointId' => 'required'
        ]);

        Point::destroy(request()->input('pointId'));
        return "Item has been marked completed";
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

}
