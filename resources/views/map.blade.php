<html>
    <head>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="{{ asset('js/map_helper.js') }}"></script>
        {!! $map['js'] !!}
        <script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script> <!-- icon to show current location -->
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/map.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width"> <!-- Fix object size on mobile devices -->
</head>
<body>
<div class="container">
    <div class="content">
        {!! $map['html'] !!}
        <div id="topCenterControl" class="nav-controls">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" id="addMarker">Add Marker</button>
                <button type="button" class="btn btn-primary" id="showMaintenance">Show Maintenance Items</button>
                <button type="button" class="btn btn-primary" id="showPointsOfInterest">Show Points Of Interest</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" id="showMaintenanceSchedules">Manage Default Schedules</a>
                        <a class="dropdown-item" href="#">Todo - List Maintenance Items</a>
                        <a class="dropdown-item" href="#">Todo - Show Account Preferences</a>
                        <a class="dropdown-item" href="#">Todo - Manage Visible POIs</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Todo - Show Social Media Mentions</a>
                    </div>
            </div>
        </div>
    </div>
</div>

 @include('modals.map_add_marker')
 @include('modals.map_view_schedules')

</body>
</html>
