var centreGot = false;

$(document).ready(function () {

    $('#modal-input-type').change(function() {
        let type = this.value;
        $.ajax({
            type: 'POST',
            url: 'get-categories-and-id-by-type',
            data: {
                type: type,
            },
            success: function (categories) {
                let categoriesSelect = $("#modal-input-categories");
                categoriesSelect.find('option').remove();
                let listItems = '';
                $.each(categories, function(key,value){
                    listItems += '<option value=' + key + '>' + value + '</option>';
                });
                categoriesSelect.append(listItems);
            }
        });

    })



    $('#showPointsOfInterest').click(function(e) {
        removeAllMarkers();
        requestMarkersByType('Feature');
    })
    $('#showAllAssets').click(function(e) {
        removeAllMarkers();
        requestMarkersByType('Assets');
    })
    $('#showAllProjects').click(function(e) {
        removeAllMarkers();
        requestMarkersByType('Projects');
    })

    $('#showAllPoints').click(function(e) {
        removeAllMarkers();
        requestMarkersByType('All');
    })

    $('#showMaintenance').click(function (e) {
        removeAllMarkers();
        requestAllTasks();
    });

    $('#validateTasks').click(function (e) {
        $.ajax({
            type: 'POST',
            url: 'execute-validate-tasks',
            success: function (data) {
                $('#toast-status-body').html(data);
                $('#toast-status').toast('show');
            }
        });
    });

    $('#validatePictures').click(function (e) {
        $.ajax({
            type: 'POST',
            url: 'execute-validate-pictures',
            success: function (data) {
                $('#toast-status-body').html(data);
                $('#toast-status').toast('show');
            }
        });
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



}); //End On Load Complete



function hideMapDrawControls() {
    drawingManager.setOptions({
        drawingControl: false,
        drawingMode: null
    });
}

function AddMarkerToMap(markerProperties) {
    let latlng = new google.maps.LatLng(markerProperties.lat, markerProperties.lng);
    let marker = new google.maps.Marker({
        position: latlng,
        title: markerProperties.title,
        cursor: 'Cursor',
        content: markerProperties.description,
        icon: (markerProperties.icon != null ? markerProperties.icon : (markerProperties.default_icon != null ? markerProperties.default_icon : markerProperties.category.default_icon)),
        animation: google.maps.Animation.DROP,
        map: map
    });
    markers_map.push(marker);

    marker.addListener('click', function() {
        iw_map.setContent(this.get('content'));
        iw_map.open(map, marker);
    });
}

function removeAllMarkers(){
    for(let i=0; i<markers_map.length; i++){
        markers_map[i].setMap(null);
    }
    markers_map = [];
}


function requestMarkersByType($type) {
    $.ajax({
        type: 'POST',
        url: 'get-points-by-type',
        data: {
            category_type: $type,
        },
        success: function (markersProperties) {
            markersProperties.forEach(function (markerProperties) {
                AddMarkerToMap(markerProperties);
            })
        }
    });
}
function requestAllTasks() {
    $.ajax({
        type: 'POST',
        url: 'get-maintenance-markers',
        data: {
            daysToLookAhead: 14,
        },
        success: function (markersProperties) {
            markersProperties.forEach(function(marker){
                AddMarkerToMap(marker);
            })
        }
    });
}

//called from snippet added in MapController
function onMapLoadComplete(){
    new klokantech.GeolocationControl(map, 0, google.maps.ControlPosition.RIGHT_CENTER);
    let mapCanvas = $('#map_canvas');
    mapCanvas.on('click','.editMarker', function() {showMarkerModalEdit($(this).attr('point-id'));});
    mapCanvas.on('click','.editMarkerSchedule', function() {showScheduleModalEditMarker($(this).attr('point-id'));});
    mapCanvas.on('click','.taskMarkCompleted', function() {taskMarkerCompleted($(this).attr('task-id'));});
    mapCanvas.on('click','.maintenanceMarkCompleted', function() {maintenanceMarkerCompleted($(this).attr('point-id'));});


}


function taskMarkerCompleted(taskId) {
    $.ajax({
        type: 'POST',
        url: 'execute-mark-task-complete',
        data: {
            taskId: taskId
        },
        success: function (data) {
            $('#toast-status-body').html(data);
            $('#toast-status').toast('show');
            removeAllMarkers();
            requestAllTasks();
        }
    });

}

function maintenanceMarkerCompleted(pointId) {
    $.ajax({
        type: 'POST',
        url: 'execute-mark-maintenance-complete',
        data: {
            pointId: pointId
        },
        success: function (data) {
            $('#toast-status-body').html(data);
            $('#toast-status').toast('show');
            removeAllMarkers();
            requestAllTasks();
        }
    });
}

