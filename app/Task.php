<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Task
 *
 * @mixin Builder
 * @property int $id
 * @property int $schedule_id
 * @property int $mappoints_id
 * @property string $status
 * @property int $type_id
 * @property string $estimated_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereEstimatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereMappointsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereTypeId($value)
 * @property int $points_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task wherePointsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Task whereUpdatedAt($value)
 * @property-read \App\Point|null $point
 */
class Task extends Model
{
    //
    protected $guarded = [];

    public function point() {
        return $this->hasOne('App\Point','id', 'points_id');
    }

    
    public function events() {
        return $this->hasMany('App\TaskEvent','tasks_id', 'id');
    }

    public function setStatusAttribute($value) {
        $this->attributes['status'] = $value;
        if($value == 'Completed') {
            $this->attributes['completed_date'] = carbon::now();
        }
    }

    public function CreateAllTasksFromSchedules () {
        // TODO:
        // 1: Get Items from Schedules
        // 2: Get Associated Table referenced values
        // 3: Insert Into Tasks Table if Not Exist
        // 4: Take into account cascading dates
        $schedules = Schedule::all();
        foreach ($schedules as $schedule) {
            $this->VerifyOrCreateFutureTasks($schedule);
        }
    }

    private function VerifyOrCreateFutureTasks(Schedule $schedule) {
        $this->CancelTasksWhereMultipleOverdue($schedule);
        $this->CancelTasksWhenMoreScheduledThanRequired($schedule);

        if($schedule->isScheduleLocationsFromCategory()) {
            $schedulePoints = $schedule->GetAllSchedulePointsIdFromCategory();
            foreach($schedulePoints as $points_id) {
                $this->CreateAllMissingTasksFromDefaultSchedulePointID($schedule, $points_id);
            }
        } else {
            if($this->GetOpenTaskCountFromOverrideSchedule($schedule) != $this->GetFutureTasksToGenerateCount($schedule)) {
                $this->CreateAllMissingTasksFromOverrideSchedule($schedule);
            }
        }

    }

    private function GetFutureTasksToGenerateCount($schedule) {
        if($schedule->item_category == NULL ) {
            $futureTasksToGenerateCount = $schedule->future_events_to_generate;
        } else {
            $PointsAffectedBySchedule = (new Point)->where('categories_id','=',  $schedule->categories_id )->whereNotIn('id', DB::table('schedules')->where('points_id', '!=', null)->pluck('points_id'))->count();
            $futureTasksToGenerateCount = $schedule->future_events_to_generate * $PointsAffectedBySchedule;
        }
        return $futureTasksToGenerateCount;
    }

    private function GetOpenTaskCountFromOverrideSchedule(Schedule $schedule) {
        return Task::whereNotIn('status',['Cancelled', 'Completed'])
                    ->where('schedule_id', $schedule->id)
                    ->count();
    }

    private function GetOpenTaskCountFromDefaultSchedulePointID(Schedule $schedule, $points_id) {
        return Task::whereNotIn('status',['Cancelled', 'Completed'])
                    ->where('schedule_id', $schedule->id)
                    ->where('points_id', '=', $points_id)
                    ->count();
    }

    private function CreateAllMissingTasksFromOverrideSchedule(Schedule $schedule) {
        $numberOfTaskToCreate =  $schedule->future_events_to_generate - $this->GetOpenTaskCountFromOverrideSchedule($schedule);
        While($numberOfTaskToCreate-- > 0) {
            $this->CreateNextOverrideScheduledTask($schedule);
        }
    }

    private function CreateAllMissingTasksFromDefaultSchedulePointID(Schedule $schedule, $points_id) {
        $numberOfTaskToCreate =  $schedule->future_events_to_generate - $this->GetOpenTaskCountFromDefaultSchedulePointID($schedule, $points_id);
        While($numberOfTaskToCreate-- > 0) {
            $this->CreateNextDefaultScheduledTask($schedule, $points_id);
        }
    }

    private function CreateNextOverrideScheduledTask(Schedule $schedule) {

        (new Task)->create(
            ['schedule_id' => $schedule->id,
                'points_id' => $schedule->points_id,
                'status' => 'Future',
                'type_id' => '1',
                'estimated_date' => $this->GetNextTaskDate($schedule, $schedule->points_id)
            ]
        );
    }

    private function CreateNextDefaultScheduledTask(Schedule $schedule, $points_id) {
        (new Task)->create(
            [   'schedule_id' => $schedule->id,
                'points_id' => $points_id,
                'status' => 'Future',
                'type_id' => '1',
                'estimated_date' => $this->GetNextTaskDate($schedule, $points_id)
            ]
        );
    }

    private function GetNextTaskDate(Schedule $schedule, $points_id) {
        $dateOfLastTaskCompleted = (new Task)->whereNotIn('status',['Cancelled'])->where('schedule_id', $schedule->id)->where('points_id', $points_id)->max('completed_date');
        
        if($schedule->cascade_future_tasks_on_completion) {
            $dateOfLastTaskEstimated = (new Task)->whereNotIn('status',['Cancelled','Completed'])->where('schedule_id', $schedule->id)->where('points_id', $points_id)->max('estimated_date');
            $dateOfLastTask = max($dateOfLastTaskCompleted, $dateOfLastTaskEstimated);
        } else {
            $dateOfLastTaskEstimated = (new Task)->whereNotIn('status',['Cancelled'])->where('schedule_id', $schedule->id)->where('points_id', $points_id)->max('estimated_date');
            $dateOfLastTask = $dateOfLastTaskEstimated;
        }

        if($dateOfLastTask == null) $dateOfLastTask = $schedule->start_date;
        $dateOfNextTask = carbon::parse($dateOfLastTask)->addDays($schedule->frequency->duration_in_days);
        return max($dateOfNextTask, carbon::now());
    }

    private function CancelTasksWhenMoreScheduledThanRequired(Schedule $schedule) {     
        $points = (new Task)->distinct('points_id')->where('schedule_id', '=', $schedule->id)->pluck('points_id');
        foreach($points as $point_id) {
              if($this->GetOpenScheduledTaskCountByPoint($schedule, $point_id) > $schedule->future_events_to_generate) {
                $tasks = (new Task) ->skip($schedule->future_events_to_generate)
                                    ->take(PHP_INT_MAX)
                                    ->where('schedule_id', '=', $schedule->id)
                                    ->where('points_id', '=', $point_id)
                                    ->whereNotIn('status',['Cancelled', 'Completed'])
                                    ->orderByDesc('estimated_date')
                                    ->get();
                foreach($tasks as $task) {
                    $this->CancelTaskWithMessage($task, 'Automatically cancelled via schedule audit: Too Many Concurrent Tasks');
                }
            }
        }
    }

    private function GetOpenScheduledTaskCountByPoint(Schedule $schedule, $point_id) {
        return Task::whereNotIn('status',['Cancelled', 'Completed'])->where('schedule_id', '=', $schedule->id)->where('points_id','=',$point_id)->count();
    }

    private function CancelTasksWhereMultipleOverdue(Schedule $schedule) {
        $points = (new Task)->distinct('points_id')->where('schedule_id', '=', $schedule->id)->pluck('points_id');
        foreach($points as $point_id) {
            if($this->GetOverdueTaskCountByScheduleAndPoint($schedule, $point_id) > 1) {
                $tasks = (new Task)->skip(1)->take(PHP_INT_MAX)->whereNotIn('status',['Cancelled', 'Completed'])->where('schedule_id', '=', $schedule->id)->where('estimated_date','<=', carbon::now())->orderByDesc('estimated_date')->get();
                foreach($tasks as $task) {
                    $this->CancelTaskWithMessage($task, 'Automatically cancelled via schedule audit: Multiple Overdue');
                }
            }
        }
    }

    private function GetOverdueTaskCountByScheduleAndPoint(Schedule $schedule, $point_id) {
        return Task::whereNotIn('status',['Cancelled', 'Completed'])
                    ->where('schedule_id', '=', $schedule->id)
                    ->where('points_id', '=', $point_id)
                    ->where('estimated_date','<=', carbon::now())
                    ->count();
    }

    private function CancelTaskWithMessage(Task $task, string $message) {
        $task->status = 'Cancelled';
        $task->save();
        TaskEvent::Insert(
            [
                'tasks_id' => $task->id,
                'notes' => $message,
                'event_occurred_at' => carbon::now()
            ]
        );
    }

}
