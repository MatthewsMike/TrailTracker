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
                        AddMarkerToMap(markerProperties, markerProperties.category.default_icon);
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
                        AddMarkerToMap(markerProperties, markerProperties.default_icon);
                    })
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
}

