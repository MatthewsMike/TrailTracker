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
            <div class="btn-group" role="group" aria-label="TrailTracker-Controls">
                <button type="button" class="btn btn-primary" id="addMarker">Add Marker</button>
                <button type="button" class="btn btn-primary" id="showMaintenance">Show Maintenance Items</button>
                <button type="button" class="btn btn-primary" id="showPointsOfInterest">Show Points Of Interest</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                    <div class="dropdown-menu">
                        @auth
                            <a class="dropdown-item" href="#" id="showMaintenanceSchedules">Manage Default Schedules</a>
                            <a class="dropdown-item" href="#" id="showCategories">Manage Categories</a>
                            <a class="dropdown-item" href="#" id="validateTasks">Validate Tasks</a>
                            <a class="dropdown-item" href="#" id="validatePictures">Validate Pictures</a>
                            <a class="dropdown-item" href="#" id="showAllPoints">Show Points</a>
                            <a class="dropdown-item" href="#" id="showAllAssets">Show Assets</a>
                            <a class="dropdown-item" href="#" id="showAllProjects">Show Projects</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout" id="logOut">{{__('Logout')}}</a>
                            <a class="dropdown-item" href="#"> TODO - List Maintenance Items</a>
                            <a class="dropdown-item" href="#"> TODO - Show Account Preferences</a>
                            <a class="dropdown-item" href="#"> TODO - Manage Visible POIs</a>
                            <a class="dropdown-item" href="#"> TODO - Show Social Media Mentions</a>
                        @endauth
                        @guest
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" data-toggle="modal" data-target="#loginModal" id="logIn">{{__('Login')}}</a>
                            <a class="dropdown-item" href="{{ url('/redirect') }}">Login with Google</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#registerModal">{{ __('Register') }}</a>
                        @endguest
                    </div>
            </div>
        </div>
    </div>
</div>

@include('modals.map_edit_marker')
@include('modals.map_view_schedules')
@include('modals.map_view_categories')
@include('modals.login')
@include('modals.register')
@include('snippets.toast')
@yield('scripts')
</body>
</html>
