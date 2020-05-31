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
            requestAllMarkers()
        })

        $('#showMaintenance').click(function (e) {
            removeAllMarkers();
            requestAllTasks();
        });

        $('#ValidateTasks').click(function (e) {
            $.ajax({
                type: 'POST',
                url: 'execute-validate-tasks',
                success: function (data) {
                    $('#toast-status-body').html(data);
                    $('#toast-status').toast('show');
                }
            });
        });

        $('#ValidatePictures').click(function (e) {
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

function AddMarkerToMap(markerProperties, defaultIcon) {
    let latlng = new google.maps.LatLng(markerProperties.lat, markerProperties.lng);
    let marker = new google.maps.Marker({
        position: latlng,
        title: markerProperties.title,
        cursor: 'Cursor',
        content: markerProperties.description,
        icon: (markerProperties.icon != null ? markerProperties.icon : defaultIcon),
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

function requestAllMarkers() {
    $.ajax({
        type: 'POST',
        url: 'get-points-of-interest-markers',
        data: {
            daysToLookAhead: 14,
        },
        success: function (markersProperties) {
            markersProperties.forEach(function (markerProperties) {
                AddMarkerToMap(markerProperties, markerProperties.category.default_icon);
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
                AddMarkerToMap(marker, marker.default_icon);
            })
        }
    });
}

//called from snippet added in MapController
function onMapLoadComplete(){
    new klokantech.GeolocationControl(map);
    let mapCanvas = $('#map_canvas');
    mapCanvas.on('click','.editMarker', function() {showMarkerModalEdit(this.id);});
    mapCanvas.on('click','.taskMarkCompleted', function() {taskMarkerCompleted($(this).attr('task-id'));});
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
