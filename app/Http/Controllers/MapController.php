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

class MapController extends Controller
{

    protected $gmap;

    public function __construct(GMaps $gmap){
        $this->gmap = $gmap;
    }

    public function index(){

        /******** Custom Map Controls ********/
        $Controls = ['document.getElementById("topCenterControl")'];
        $this->gmap->injectControlsInTopCenter = $Controls;


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

        //$config['center'] = '44.655694,-63.734611';
        $config['center'] = 'auto';
        //$config['center'] = 'Halifax, Nova Scotia';
        //$config['kmlLayerURL'] = 'https://blttrails.ca/BLTTrailMap.kml';
        $config['map_type'] = 'SATELLITE';

        $this->gmap->initialize($config); // Initialize Map with custom configuration

        // set up the marker ready for positioning
        $marker = array();
        $marker['draggable'] = true;
        $marker['ondragend'] = '
        iw_'. $this->gmap->map_name .'.close();
        reverseGeocode(event.latLng, function(status, result, mark){
            if(status == 200){
                iw_'. $this->gmap->map_name .'.setContent(result);
                iw_'. $this->gmap->map_name .'.open('. $this->gmap->map_name .', mark);
            }
        }, this);
        ';

        $this->gmap->add_marker($marker);

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
        Log::debug('Using Icon: ' . $POI->category->default_icon );
        $marker = array();
        $marker['position']= $POI->lat . ',' . $POI->lng;
        $marker['infowindow_content'] = $POI->description;
        $marker['cursor'] = $POI->title;
        $marker['icon'] = $POI->icon ?: $POI->category->default_icon;
        $marker['title'] = $POI->title;
        return $marker;
    }

    public function saveNewMarker(Request $request) {
        request()->validate([
            'lat' => 'required',
            'lng' => 'required',
            'title' => 'required',
            'categories_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);
        $newMarker = $request->all();

        $imageName = (new \App\Category)->getCategoryNameByID($newMarker['categories_id']) . '-' . $newMarker['title'] . '-' . time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $newMarker['image'] = $imageName;


        (new Point)->create($newMarker);
        (new Task)->CreateAllTasksFromSchedules();  //todo: remove from debugging.

        $newMarker['icon'] = (new \App\Category)->getDefaultIconByID($newMarker['categories_id']);
        return  response()->json($newMarker);
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
        return response()->json((new Task)->join('points','tasks.points_id','=', 'points.id')->join('categories','points.categories_id', '=','categories.id')->whereNotIn('status',['Cancelled', 'Completed'])->where('estimated_date','<=', carbon::now()->addDays($request->input('daysToLookAhead')))->get());

    }

    public function GetAllPointsOfInterestJSON() {
        return response()->json($this->getAllPointsOfInterest());
    }

    public function getCategoriesByTypesJSON(Request $request) {
        return response()->json((new Category)->getCategoriesAndIdByType($request->input('type')));

    }

    public function getScheduleByCategoryIDJSON(Request $request) {
        return response()->json((new Schedule)::where('categories_id',$request->input('categories_id'))->first());
    }
}
