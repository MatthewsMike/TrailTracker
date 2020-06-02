## About Trail Tracker

This application is designed as a proof of concept way of crowdsourcing maintenance of multi use trails.  The initial goal is to provide a system to view and act on maintenance tasks.  Task can be generated from user submissions (Downed Tree), or by a schedule (Empty Garbage).
- [BLT Rails to Trails](https://blttrails.ca/)

 - remove** marker that was deleted/ task completed (perhaps add property on marker called "marker_id" and have that as an attr of the infowindow buttons)
 
 - todo: consider POI's only belonging to feature category, Maintenance category will be supplemental to tasks.
 - todo: make POI info window contain actions/option button per type
   - Maintenance: Accept, Release, Complete (with note), Review Schedule Default/This Point
   - Allow Override schedule per point
   - Feature: report condition, Hide this type, etc
- todo: Add better task generation from schedule. 
    - Possibly remove 'Future task count to generate' feature. 
    - Add Cron Job to update Status from Future -> Current -> Overdue
- todo: Track IP address of submissions
- todo: enable Authentication
- todo: create view for Members/users
- todo: allow users to designate volunteer area for alerts
- todo: allow users to indicate frequency of helping
- todo: allow users to be alerted on multiple conditions: location, age of task, skills, etc.
- todo: integrate social media content that contains location data in geofence area.
- todo: add machine learning to generate maintenance items based on "inspection" tasks
   - Garbage Icons based on predicted fullness.
- todo: reevaluate integration with bluimp image upload plugin as it allows client side image resizing to save mobile data.
