## About Trail Tracker

This application is as a proof of concept for managing and crowdsourcing maintenance of a multi use trail.  The initial goal is to provide a system to view and act on maintenance tasks.  Task can be generated from user submissions (Downed Tree), or by a schedule (Empty Garbage).
- [BLT Rails to Trails](https://blttrails.ca/)

#todo

##Next

##Future

####Bugs
1. Perform error handling on AJAX form submissions

####Performance
1. Remove marker that was deleted/ task completed (perhaps add property on marker called "marker_id" and have that as an attr of the infowindow buttons)
 
####Features
1. Allow for viewing of events for a marker.  (i.e. Project category marker can have status updates)
1. Allow for Override schedule for an individual marker. 
1. Track replaced pictures for points.
1. Allow severity rating of any "Maintenance" category point. (This would be favorite rating for Feature). Implement when tacking Vue?
1. Make POI info window contain actions/option button per type
   1. Maintenance: Accept, Release, Complete (with note), Review Schedule Default/This Point
   1. Allow Override schedule per point
   1. Feature: report condition, Hide this type, etc
1. Generate modal which displays a list view of upcoming tasks by date.
    1. Severity of Maintenance point + created date will determine due date.
1. Add better task generation from schedule. 
    1. Possibly remove 'Future task count to generate' feature. 
    1. Add Cron Job to update Status from Future -> Current -> Overdue
1. Track IP address of submissions
1. Enable Authentication
    1. Create view for Members/users
    1. Allow users to designate volunteer area for alerts
    1. Allow users to indicate frequency of helping
    1. Allow users to be alerted on multiple conditions: location, age of task, skills, etc.
    1. Allow for choice in POI's to be displayed (Projects, Assets)
1. Integrate social media content that contains location data in geofence area.
1. Add machine learning to generate maintenance items based on "inspection" tasks
   1. Garbage Icons based on predicted fullness.
1. Reevaluate integration with bluimp image upload plugin as it allows client side image resizing to save mobile data.
1. [Add Social Login](https://stormpath.com/blog/stormpath-laravel-social-login#:~:text=In%20the%20%E2%80%9CSite%20URL%E2%80%9D%20box,again%20and%20enter%20another%20URL.)

####Clean-Up
1. Pull todo comments into readme
1. Consider Moving JS for Modals to external files for compiling
1. Create thank you / attribution note for all packages used
1. Review language to make use of Marker/POI/Point consistent
1. Rename routes to [Laravel Naming Convention Standards](https://webdevetc.com/blog/laravel-naming-conventions)
1. Split Map Controller
1. Deal with Dependency injection



