<html>
    <head>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/all.js') }}"></script>
        {!! $map['js'] !!}
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/map.css') }}" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width"> <!-- Fix object size on mobile devices -->
</head>
<body>
<div class="container" id="container">
    <div class="content">
        {!! $map['html'] !!}
        <div id="custom-controls" class="nav-controls">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" id="addMarker">Add Marker</button>
                <button type="button" class="btn btn-primary" id="showMaintenance">Show Maintenance Items</button>
                <button type="button" class="btn btn-primary" id="showPointsOfInterest">Show Points Of Interest</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" id="showMaintenanceSchedules">Manage Default Schedules</a>
                        <a class="dropdown-item" href="#" id="showCategories">Manage Categories</a>
                        <a class="dropdown-item" href="#" id="ValidateTasks">Validate Tasks</a>
                        <a class="dropdown-item" href="#" id="ValidatePictures">Validate Pictures</a>
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

<div aria-live="polite" aria-atomic="true">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" id="toast-status"  style="position: absolute; top: 0; right: 0;">
        <div class="toast-header" >
            <strong class="mr-auto">Message Log</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-status-body">
        </div>
    </div>
</div>

 @include('modals.map_edit_marker')
 @include('modals.map_view_schedules')
 @include('modals.map_view_categories')

</body>
</html>
