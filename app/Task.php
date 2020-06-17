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
        // TODO: cancel tasks where more than required are scheduled
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
        $openTaskCount = (new Task)->whereNotIn('status',['Cancelled', 'Completed'])->where('schedule_id', $schedule->id)->count();
       return $openTaskCount;
    }

    private function GetOpenTaskCountFromDefaultSchedulePointID(Schedule $schedule, $points_id) {
        $openTaskCount = (new Task)->whereNotIn('status',['Cancelled', 'Completed'])->where('schedule_id', $schedule->id)->where('points_id', '=', $points_id)->count();
        return $openTaskCount;
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
        $dateOfLastTask = (new Task)->whereNotIn('status',['Cancelled'])->where('schedule_id', $schedule->id)->where('points_id', $points_id)->max('estimated_date');
        if($dateOfLastTask == null) $dateOfLastTask = $schedule->start_date;
        $dateOfNextTask = carbon::parse($dateOfLastTask)->addDays(15);
        return max($dateOfNextTask, carbon::now());
    }

    private function CancelTasksWhenMoreScheduledThanRquired() {
        // TODO 
    }

    private function CancelTasksWhereMultipleOverdue(Schedule $schedule) {
        if($this->GetOverdueTaskCount($schedule) > 1) {
            $tasks = (new Task)->skip(1)->take(PHP_INT_MAX)->whereNotIn('status',['Cancelled', 'Completed'])->where('estimated_date','<=', carbon::now())->orderByDesc('estimated_date');
            foreach($tasks as $task) {
                $this->CancelTaskWithMessage($task, 'Automatically cancelled via schedule audit');
            }
        }
    }

    private function GetOverdueTaskCount(Schedule $schedule) {
        $overdueTaskCount = (new Task)->whereNotIn('status',['Cancelled', 'Completed'])->where('schedule_id', '=', $schedule->id)->where('estimated_date','<=', carbon::now())->count();
        return $overdueTaskCount;
    }

    private function CancelTaskWithMessage(Task $task, string $message){
        $task->status = 'Cancelled';
        $task->save();
        // TODO:log event with message
    }

}
