<?php

namespace App\Http\Controllers;

use App\Category;
use App\Frequency;
use App\Schedule;
use App\Task;
use Carbon\Carbon;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;

use App\Point;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;
use function Psy\debug;

class MapController extends Controller
{

    protected $gmap;

    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
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
                $("#modal-input-lat").val(newShape.getPosition().lat());
                $("#modal-input-lng").val(newShape.getPosition().lng());
                $("#newMarker").modal("show");
            ');

        $config['center'] = 'auto';
        $config['kmlLayerURL'] = 'https://blttrails.ca/BLTMap.kml'; //Base Map of Trail
        $config['map_type'] = 'SATELLITE';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        //events that would be triggered to early by OnLoadCompleted need to be added here.
        $this->gmap->onload = "onMapLoadComplete();";

        $pointsOfInterest = $this->getAllPointsOfInterest();
        foreach($pointsOfInterest as $POI) {
            $this->gmap->add_marker($this->addMapPointsPropertiesToMarker($POI));
        }
        $map = $this->gmap->create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']

        /******** END Custom Map Configuration ********/

        $categoryTypes = (new Category())->getAllCategoryTypes();
        $categories = (new Category())->getAllCategoriesAndId();
        $frequencies  = (new Frequency())->getAllFrequenciesAndId();

        return view('map', compact(['map','categoryTypes', 'frequencies', 'categories']));
    }

    private function getAllPointsOfInterest() {

        return (new \App\Point)->with('category')->get();
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
        //Move to Point Class
        $html = "<div class=\"card\" style=\"width:302px\">";
        if($POI->image) {
            $html .= "<img class=\"card-img-top\" src=\"" . '/images/map-card/' . $POI->image ."\" alt=\"Card image\">";
        }
        $html .= "<div class=\"card-body\">";
        $html .= "<h4 class=\"card-title\">" . $POI->title . "</h4>";
        $html .= "<p class=\"card-text\">" . $POI->description . ".</p>";
        $html .= "<button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Options</button>";
        $html .= "    <div class=\"dropdown-menu\">";
        $html .= "        <a class=\"dropdown-item\" href=\"#\">todo Manage Schedule</a>";
        $html .= "        <a class=\"dropdown-item\" href=\"#\">todo Report Condition</a>";
        $html .= "        <a class=\"dropdown-item editMarker\" href=\"#\" id='". $POI->id ."'>Edit Marker</a>";
        $html .= "        <a class=\"dropdown-item\" href=\"#\">todo Hide This Type</a>";
        $html .= "        <a class=\"dropdown-item\" href=\"#\">todo Rate</a>";
        $html .= "    </div>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }
    private function generateInfoWindowFromTask($task) {
        //Move to Point Class
        $html = "<div class=\"card\" style=\"width:302px\">";
        if($task->image) {
            $html .= "<img class=\"card-img-top\" src=\"" . '/images/map-card/' . $task->image ."\" alt=\"Card image\">";
        }
        $html .= "<div class=\"card-body\">";
        $html .= "<h4 class=\"card-title\">" . $task->title . "</h4>";
        $html .= "<p class=\"card-text\">" . $task->description . ".</p>";
        $html .= "<button type=\"button\" class=\"btn btn-danger dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Options</button>";
        $html .= "    <div class=\"dropdown-menu\">";
        $html .= "        <a class=\"dropdown-item editMarker\" href=\"#\" id='". $task->id ."'>Edit Marker</a>";
        $html .= "        <a class=\"dropdown-item\" href=\"#\">todo Mark Completed</a>";
        $html .= "        <a class=\"dropdown-item\" href=\"#\">todo Assign</a>";
        $html .= "        <a class=\"dropdown-item\" href=\"#\">todo Delegate</a>";
        $html .= "        <a class=\"dropdown-item\" href=\"#\">todo Report Condition</a>";
        $html .= "    </div>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }

    private function verifyAllMapCardImagesResized() {
        $images = (new Point)->where('image', '!=', '')->pluck('image');
        foreach($images as $image) {
            if(is_file(public_path('/images/' . $image))) {
                if(!$this->isMapCardImageCreated($image)) {
                    $this->resizeImageForMapCard($image);
                }
            }
        }
    }

    private function isMapCardImageCreated($image) {
        if(is_file(public_path('/images/map-card/' . $image))) {
            return true;
        }
        return false;
    }

    private function resizeImageForMapCard($image) {
        Image::make(public_path('/images/' . $image))
            ->resize(300, null, function ($constraint) {$constraint->aspectRatio();})
            ->save(public_path('/images/map-card/' . $image));
    }

    public function saveNewMarker(Request $request) {
        request()->validate([
            'lat' => 'required',
            'lng' => 'required',
            'title' => 'required',
            'categories_id' => 'required',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);
        $newMarker = $request->all();
        if($request->has('image')) {
            $imageName = (new \App\Category)->getCategoryNameByID($newMarker['categories_id']) . '-' . $newMarker['title'] . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $this->resizeImageForMapCard($imageName);
            $newMarker['image'] = $imageName;
        }
        $POI = (new Point)->create($newMarker);
        $POI['icon'] = (new \App\Category)->getDefaultIconByID($POI['categories_id']);
        $POI['description'] = $this->generateInfoWindowFromPoint($POI);

        //todo: trigger schedule generation for new POI
        return  response()->json($POI);
    }


    public function saveEditMarker(Request $request) {
        request()->validate([
            'lat' => 'required',
            'id' => 'required',
            'lng' => 'required',
            'title' => 'required',
            'categories_id' => 'required',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:15000'
        ]);
        $newMarker = $request->all();

        if($request->has('image')) {
            $imageName = (new \App\Category)->getCategoryNameByID($newMarker['categories_id']) . '-' . $newMarker['title'] . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $this->resizeImageForMapCard($imageName);
            $newMarker['image'] = $imageName;
        }

        $POI = Point::updateOrCreate(['id' => $request->input('id')], $newMarker);
        $POI['icon'] = (new \App\Category)->getDefaultIconByID($POI['categories_id']);
        $POI['description'] = $this->generateInfoWindowFromPoint($POI);
        return  response()->json($POI);
    }


    public function saveCategorySchedule(Request $request) {
        request()->validate([
            'frequency_id' => 'required',
            'start_date' => 'required|date',
            'title' => 'required',
            'description' => 'required',
            'future_events_to_generate' => 'required',
            'cascade_future_tasks_on_completion' => 'required',
            'categories_id' => 'required',
            'reward_points' => 'required',
            'action' => 'required'
        ]);
        $schedule = Schedule::updateOrCreate(['id' => $request->input('id')], $request->all());
        $response = "Default Schedule Updated For " . $schedule->category->name;
        return  response()->json($response);
    }


    public function GetAllTasksInDateRangeJSON(Request $request) {
        //todo: only return 1st of series (distinct on points_id and type of task) - Min Date.
        $taskCollection = (new Task)->join('points','tasks.points_id','=', 'points.id')->join('categories','points.categories_id', '=','categories.id')->whereNotIn('status',['Cancelled', 'Completed'])->where('estimated_date','<=', carbon::now()->addDays($request->input('daysToLookAhead')))->get();
        $taskCollection = $taskCollection->map(function($task) {
            $task['description'] = $this->generateInfoWindowFromPoint($task);
            return $task;
        });
        return response()->json($taskCollection);

    }

    public function getMarkerByIDJSON(Request $request) {
        return response()->json((new Point())::where('id', $request->input('id'))->first());
    }

    public function GetAllPointsOfInterestJSON() {
        $POIs = $this->getAllPointsOfInterest();
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
        $this->verifyAllMapCardImagesResized();
        return "All Pictures Verified";
    }

}
