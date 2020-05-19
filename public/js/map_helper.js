   var centreGot = false;
    $(document).ready(function () {

        $("#modal-input-type").change(function() {
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

        $("#showPointsOfInterest").click(function(e) {
            removeAllMarkers();
            $.ajax({
                type: 'POST',
                url: 'get-points-of-interest-markers',
                data: {
                    daysToLookAhead: 14,
                },
                success: function (markersProperties) {
                    markersProperties.forEach(function(markerProperties){
                        console.log(markerProperties.title);
                        let latlng = new google.maps.LatLng(markerProperties.lat, markerProperties.lng);
                        markers_map.push (new google.maps.Marker({
                                position: latlng,
                                title: markerProperties.title,
                                animation: google.maps.Animation.DROP,
                                map: map
                                //todo - populate all marker properties
                            })
                        );
                    })
                }
            });
        })

        $("#showMaintenance").click(function (e) {
            removeAllMarkers();
            $.ajax({
                type: 'POST',
                url: 'get-maintenance-markers',
                data: {
                    daysToLookAhead: 14,
                },
                success: function (markersProperties) {
                    markersProperties.forEach(function(markerProperties){
                        AddMarkerToMap(markerProperties);
                    })
                }
            });
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    });



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
        icon: markerProperties.icon,
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
}

