
<html>
    <head>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script type='text/javascript'>  var centreGot = false; </script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    {!! $map['js'] !!}
        <!-- Styles -->
        <link href="{{ asset('css/map.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <div class="content">
        <div id="bottomCenterControl" style="padding: 5px; background-color:#fff; box-shadow: #101010; margin: 2px;">
            <button type="button" class="btn btn-primary" id="addMarker">Add Marker</button>
            <button type="button" class="btn btn-primary" id="showMaintenance">Show Maintenance Items</button>
            <button type="button" class="btn btn-primary" id="showPointsOfInterest">Show Points Of Interest</button>
        </div>
        {!! $map['html'] !!}
    </div>
</div>

    <div id="newMarker" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit New Marker</h5>
                    <button type="button" class="close btn-cancel btn-cancel-new-marker" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-marker-form" class="form-horizontal" method="POST">
                        <div class="card-body">
                            <!-- Position -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-id">Lat</label>
                                <input type="text" name="modal-input-lat" class="form-control" id="modal-input-lat" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-id">Lng</label>
                                <input type="text" name="modal-input-lng" class="form-control" id="modal-input-lng" required>
                            </div>
                            <!-- Position -->
                            <!-- title -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-name">Title</label>
                                <input type="text" name="modal-input-title" class="form-control" id="modal-input-title" required autofocus>
                            </div>
                            <!-- /title -->
                            <!-- description -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-description">Description</label>
                                <input type="text" name="modal-input-description" class="form-control" id="modal-input-description">
                            </div>
                            <!-- /description -->
                            <!-- Type -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-type">Type</label>
                                <input type="text" name="modal-input-type" class="form-control" id="modal-input-type" required>
                            </div>
                            <!-- /type -->
                            <!-- category -->
                            <div class="form-group">
                                <label class="col-form-label" for="modal-input-category">Category</label>
                                <input type="text" name="modal-input-description" class="form-control" id="modal-input-categories" required>
                            </div>
                            <!-- /category -->
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-submit" id="btn-save-new-marker">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-cancel btn-cancel-new-marker" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#addMarker").click(function (e) {
            drawingManager.setOptions({
                drawingControl: true,
                drawingMode: 'marker'
            });

        });

        $("#showPointsOfInterest").click(function(e) {
            removeAllMarkers();
            $.ajax({
                type: 'POST',
                url: '/get-points-of-interest-markers',
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
                url: '/get-maintenance-markers',
                data: {
                    daysToLookAhead: 14,
                },
                success: function (markersProperties) {
                    markersProperties.forEach(function(markerProperties){
                        console.log(markerProperties.title);
                        let latlng = new google.maps.LatLng(markerProperties.lat, markerProperties.lng);
                        markers_map.push( new google.maps.Marker({
                            position: latlng,
                            title: markerProperties.title,
                            animation: google.maps.Animation.DROP,
                            map: map
                            //todo - populate all marker properties
                        })
                        )
                    })
                }
            });
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-cancel-new-marker").click(function (e) {
            hideMapDrawControls();
        });

        $("#btn-save-new-marker").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/save-new-marker',
                data: {
                    address: $('#modal-input-address').val(),
                    lat: $('#modal-input-lat').val(),
                    lng: $('#modal-input-lng').val(),
                    categories: $('#modal-input-categories').val(),
                    type: $('#modal-input-type').val(),
                    title: $('#modal-input-title').val(),
                    description: $('#modal-input-description').val(),
                    icon: $('#modal-input-icon').val(),
                    options: $('#modal-input-options').val(),
                    url: $('#modal-input-url').val()
                },
                success: function (markerProperties) {
                    let latlng = new google.maps.LatLng(markerProperties.lat, markerProperties.lng);
                    markers_map.push( new google.maps.Marker({
                        position: latlng,
                        title: markerProperties.title,
                        animation: google.maps.Animation.DROP,
                        map: map
                        //todo - populate all marker properties
                        })
                    );
                    map.setCenter(marker.getPosition());
                    $('#newMarker').modal('hide');
                    hideMapDrawControls();
                }
            });

        });
    });

    function hideMapDrawControls() {
        drawingManager.setOptions({
            drawingControl: false,
            drawingMode: null
        });
    }

    function removeAllMarkers(){
        for(let i=0; i<markers_map.length; i++){
            markers_map[i].setMap(null);
        }
    }

</script>
</body>
</html>
