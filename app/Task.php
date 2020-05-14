<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
 */
class Task extends Model
{
    //
    protected $guarded = [];

    public function CreateAllTasksFromSchedules () {
        log::debug('Creating all Tasks From Schedules');
        //todo:
        // 1: Get Items from Schedules
        // 2: Get Associated Table referenced values
        // 3: Insert Into Tasks Table if Not Exist
        // 4: Take into account cascading dates
        $schedules = Schedule::all();
        foreach ($schedules as $schedule) {
            Log::debug('Processing Schedule Id ' . $schedule->id);
            $this->VerifyOrCreateFutureTasks($schedule);
        }
    }

    private function VerifyOrCreateFutureTasks(Schedule $schedule) {
        $this->CancelTasksWhereMultipleOverdue($schedule);
        //todo: cancel tasks where more than required are scheduled
        if($this->GetOpenTaskCount($schedule) != $this->GetFutureTasksToGenerateCount($schedule)) {
            $this->CreateAllMissingTasksFromSchedule($schedule);
        }

    }

    private function GetFutureTasksToGenerateCount($schedule) {

        if($schedule->item_category == NULL ) {
            $futureTasksToGenerateCount = $schedule->future_events_to_generate;
        } else {
            $PointsAffectedBySchedule = (new Point)->where('categories','like', '%' . $schedule->item_category . '%')->count();
            $futureTasksToGenerateCount = $schedule->future_events_to_generate * $PointsAffectedBySchedule;
        }
        log::debug('Future Tasks To Generate Count: ' . $futureTasksToGenerateCount);
        return $futureTasksToGenerateCount;
    }

    private function GetOpenTaskCount(Schedule $schedule) {
        $openTaskCount = (new Task)->whereNotIn('status',['Cancelled', 'Completed'])->where('schedule_id', $schedule->id)->count();
        Log::debug('Open Task Count: ' . $openTaskCount);
       return $openTaskCount;
    }

    private function GetOverdueTaskCount(Schedule $schedule) {
        //todo: filter results based on schedule
        $overdueTaskCount = (new Task)->whereNotIn('status',['Cancelled', 'Completed'])->where('estimated_date','<=', carbon::now())->count();
        Log::debug('Overdue Task Count: ' . $overdueTaskCount);
        return $overdueTaskCount;
    }

    private function CreateAllMissingTasksFromSchedule(Schedule $schedule) {
        $numberOfTaskToCreate =  $schedule->future_events_to_generate - $this->GetOpenTaskCount($schedule);
        While($numberOfTaskToCreate-- > 0) {
            $this->CreateNextScheduledTask($schedule);
        }
    }

    private function CreateNextScheduledTask(Schedule $schedule) {
            //get base date.
        Log::debug('Creating New Task from Schedule id ' . $schedule->id );
        if($schedule->isScheduleLocationsFromCategory()) {
            $pointsFromCategory = $schedule->GetAllSchedulePointsIdFromCategory();
            foreach($pointsFromCategory as $point) {
                (new Task)->create(
                    [   'schedule_id' => $schedule->id,
                        'points_id' => $point->id,
                        'status' => 'future',
                        'type_id' => '1',
                        'estimated_date' => $this->GetNextTaskDate($schedule, $point->id)
                    ]
                );
            }
        }
        if($schedule->isScheduleLocationsFromPoint()) {
            (new Task)->create(
                ['schedule_id' => $schedule->id,
                    'points_id' => $schedule->points_id,
                    'status' => 'future',
                    'type_id' => '1',
                    'estimated_date' => $this->GetNextTaskDate($schedule, $schedule->points_id)
                ]
            );
        }
    }

    private function GetNextTaskDate(Schedule $schedule, $points_id) {
        $dateOfLastTask = (new Task)->whereNotIn('status',['Cancelled'])->where('schedule_id', $schedule->id)->where('points_id', $points_id)->max('estimated_date');
        if($dateOfLastTask == null) $dateOfLastTask = $schedule->start_date;
        //todo: implement frequency class
        $dateOfNextTask = carbon::parse($dateOfLastTask)->addDays(15);
        return max($dateOfNextTask, carbon::now());
    }

    private function CancelTasksWhereMultipleOverdue(Schedule $schedule) {
        if($this->GetOverdueTaskCount($schedule) > 1) {
            $tasks = (new Task)->skip(1)->take(PHP_INT_MAX)->whereNotIn('status',['Cancelled', 'Completed'])->where('estimated_date','<=', carbon::now())->orderByDesc('estimated_date');
            foreach($tasks as $task) {
                $this->CancelTaskWithMessage($task, 'Automatically cancelled via schedule audit');
            }
        }
    }

    private function CancelTaskWithMessage(Task $task, string $message){
        $task->status = 'Cancelled';
        $task->save();
        //todo:log event with message
    }


}
