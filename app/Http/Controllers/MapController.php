<?php

namespace App\Http\Controllers;

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
        $bottomCenterControls = ['document.getElementById("bottomCenterControl")'];
        $this->gmap->injectControlsInBottomCenter = $bottomCenterControls;


        /******** End Controls ********/

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
        //$config['center'] = 'auto';
        //$config['center'] = 'Halifax, Nova Scotia';
        $config['kmlLayerURL'] = 'https://blttrails.ca/BLTTrailMap.kml';
        $config['map_type'] = 'SATELLITE';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

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



        $PointsOfInterest = $this->getAllPointsOfInterest();
        foreach($PointsOfInterest as $POI) {
            $this->gmap->add_marker($this->addMapPointsPropertiesToMarker($POI));
        }
        $map = $this->gmap->create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']

        return view('map', ['map' => $map]);
    }

    private function getAllPointsOfInterest() {
        return Point::all();
    }

    private function addMapPointsPropertiesToMarker($POI) {
        $marker = array();
        $marker['position']= $POI->lat . ',' . $POI->lng;
        $marker['infowindow_content'] = $POI->description;
        $marker['cursor'] = $POI->title;
        $marker['icon'] = $POI->icon;
        $marker['title'] = $POI->title;
        return $marker;
    }

    public function saveNewMarker(Request $request) {
        request()->validate([
            'lat' => 'required',
            'lng' => 'required',
            'title' => 'required'
        ]);
        (new Point)->create($request->all());
        (new Task)->CreateAllTasksFromSchedules();  //todo: remove from debugging.
        Log::debug('Saving New Map Point');
        return  response()->json($request->all());
    }

    public function GetAllTasksInDateRangeJSON(Request $request) {
        //todo: only return 1st of series (distinct on points_id and type of task) - Min Date.
        return response()->json((new Task)->join('points','tasks.points_id','=', 'points.id')->whereNotIn('status',['Cancelled', 'Completed'])->where('estimated_date','<=', carbon::now()->addDays($request->input('daysToLookAhead')))->get());
    }

    public function GetAllPointsOfInterestJSON() {
        return response()->json($this->getAllPointsOfInterest());
    }
}
