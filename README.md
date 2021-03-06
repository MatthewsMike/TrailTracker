## About Trail Tracker

This application is as a proof of concept for managing and crowdsourcing maintenance of a multi use trail.  The initial goal is to provide a system to view and act on maintenance tasks.  Task can be generated from user submissions (Downed Tree), or by a schedule (Empty Garbage).
- [BLT Rails to Trails](https://blttrails.ca/)

# todo

## Next
1. Enable Authentication - Admin\director\member\guest roles (Consider package Laravel-permission by Spatie)
    1. Create view for Members/users
    1. Allow users to designate volunteer area for alerts
    1. Allow users to indicate frequency of helping
    1. Allow users to be alerted on multiple conditions: location, age of task, skills, etc
    1. Allow for choice in POI's to be displayed (Projects, Assets)
    1. Notify Admin when new Task (Week Summary), or Maintenance Item (Immediate, or part of week summary based on urgency)
1. For 'Add Marker' Popup new button 'current location' if location is accessible on device. 

## Future

#### Bugs
1. Add Toast messages to any failed XHR errors.

#### Performance
1. Remove marker that was deleted/ task completed (perhaps add property on marker called "marker_id" and have that as an attr of the infowindow buttons)

#### Features
1. Make POI info window contain actions/option button per type
   1. Maintenance: Accept, Release, Complete (with note), Review Schedule Default/This Point
   1. Allow Override schedule per point
   1. Feature: report condition, Hide this type, etc
1. Generate modal which displays a list view of upcoming tasks by date
    1. Severity of Maintenance point + created date will determine due date
1. Add better task generation from schedule
    1. Possibly remove 'Future task count to generate' feature. 
    1. Add Cron Job to update Status from Future -> Current -> Overdue
1. Integrate social media content that contains location data in geofence area
1. Add machine learning to generate maintenance items based on "inspection" tasks
   1. Garbage Icons based on predicted fullness
1. Reevaluate integration with bluimp image upload plugin as it allows client side image resizing to save mobile data.
1. Allow for Generation of report based on Month's activity for Board of Directors Maintenance Report
1. Allow for viewing of events for a marker.  (i.e. Project category marker can have status updates)
1. Allow for generic usage by customizing Bounds and KML base layer
1. Allow Users to change password

#### Clean-Up
1. Pull feature TODO comments into readme
1. Consider Moving JS for Modals to external files for compiling
1. Create thank you / attribution note for all packages used
1. Review language to make use of Marker/POI/Point consistent
1. Rename routes to [Laravel Naming Convention Standards](https://webdevetc.com/blog/laravel-naming-conventions)
    1. Be consistent with column name points_id vs point_id
1. Split Map Controller, move into models
1. Deal with Dependency injection
1. Fix in login/registering redirection
1. Review DB Calls in schedule model to convert to eloquent ORM
1. Fix Info Window Generation code to be cleaner
1. DIP the MapController
1. complete initial instruction setup section


# First Time Install Setup
1. clone git repo
1. configure .env file
1. In project folder, run the following commands
    1. run "composer install" 
    1. run "php artisan migrate" 
    1. run "php artisan db:seed"
... 
1. add Cron Job for Scheduled tasks triggering "* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1"
1. default admin account created on initial db migrations admin@YourDomain.TLD / password