
<html>
    <head>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/map_helper.js') }}" defer></script>
        <script type='text/javascript'>  var centreGot = false; </script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    {!! $map['js'] !!}
        <!-- Styles -->
        <link href="{{ asset('css/map.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width"> <!-- Fix object size on mobile devices -->
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

 @include('modals.map_add_marker')

<script type="text/javascript">
    $(document).ready(function () {


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


</script>
</body>
</html>
