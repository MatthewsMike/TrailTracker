<?php
/*

Task Class operates from one public function CreateAllTasksFromSchedules
all tests are done by modifying a Schedule, Point, or Task and assuring 
the integrity of the tasks table is correct.
*/
namespace Tests\Unit;

use App\Task;
use App\Point;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Tests\TestCase;

use function Psy\debug;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    protected $EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED;
    protected $CATEGORIES_ID_OF_DEFAULT_SCHEDULE;
    protected $DAYS_BETWEEN_TASKS_FOR_SEEDED_SCHEDULE;
 
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED = 7;
        $this->CATEGORIES_ID_OF_DEFAULT_SCHEDULE = 3;
        $this->DAYS_BETWEEN_TASKS_FOR_SEEDED_SCHEDULE = 30;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_class_creates_all_expected_tasks()
    {
        $this->AssertEquals(0,Task::all()->count());
        (new Task)->CreateAllTasksFromSchedules();
        $this->AssertEquals($this->EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED, Task::all()->count());
    }

    public function test_class_does_not_create_more_tasks_on_repeated_runs()
    {
        Log::debug('Failing Test Start');
        (new Task)->CreateAllTasksFromSchedules();
        (new Task)->CreateAllTasksFromSchedules();
        (new Task)->CreateAllTasksFromSchedules();
        $this->AssertEquals($this->EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED, Task::all()->count());
    }

    
    public function test_class_increase_by_1_with_1_new_point()
    {
        $point = factory(Point::class)->make();
        $point->categories_id = $this->CATEGORIES_ID_OF_DEFAULT_SCHEDULE;
        $point->save();
        (new Task)->CreateAllTasksFromSchedules();
        $this->AssertEquals($this->EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED + 1, Task::all()->count());
    }

    public function test_class_generates_new_task_after_original_completed()
    {
        (new Task)->CreateAllTasksFromSchedules();
        $task = (new Task)->first();
        $task->status = 'Completed';
        $task->save();
        (new Task)->CreateAllTasksFromSchedules();
        $this->AssertEquals($this->EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED + 1, Task::all()->count());
    }

    
    public function test_class_generates_new_task_after_original_cancelled()
    {
        (new Task)->CreateAllTasksFromSchedules();
        $task = (new Task)->first();
        $task->status = 'Cancelled';
        $task->save();
        (new Task)->CreateAllTasksFromSchedules();
        $this->AssertEquals($this->EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED + 1, Task::all()->count());
    }

    public function test_class_removes_duplicate_task()
    {
        (new Task)->CreateAllTasksFromSchedules();
        $task = (new Task)->first()->replicate();
        $task->save();
        (new Task)->CreateAllTasksFromSchedules();
        $this->AssertEquals($this->EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED, Task::all()->where('status','=','Future')->count());
    }

    
    public function test_class_adds_event_log_for_any_cancelled_tasks() {
        (new Task)->CreateAllTasksFromSchedules();
        $task = (new Task)->first()->replicate();
        $task->save();
        (new Task)->CreateAllTasksFromSchedules();
        $this->assertDatabaseHas('task_events',['tasks_id' => $task->id]);      
    }

    //cascade = next event based off most recent completed (falling back to estimated date, then start date of schedule)
    public function test_class_cascades_when_required_for_next_task()
    {
        (new Task)->CreateAllTasksFromSchedules();
        $task = (new Task)->first(); 
        $point_id = $task->points_id;
        $task->estimated_date = carbon::now()->addDays(15);
        $task->status = 'Completed';
        $task->save();       
        (new Task)->CreateAllTasksFromSchedules();
        $task = (new Task)->where('points_id', '=', $point_id)->whereNotIn('status', ['Completed', 'Cancelled'])->first();
        $this->assertEquals(carbon::now()->addDays($this->DAYS_BETWEEN_TASKS_FOR_SEEDED_SCHEDULE)->toDateString(),carbon::parse($task->estimated_date)->toDateString());
    }

    //not cascade = next event based off most recent estimated date (falling back to start date of schedule)
    public function test_class_does_not_cascade_when_not_required_for_next_task()
    {
        (new Task)->CreateAllTasksFromSchedules();
        $task = (new Task)->where('schedule_id', '=', '2')->first(); 
        $point_id = $task->points_id;
        $task->estimated_date = carbon::now()->addDays(15);
        $task->status = 'Completed';
        $task->save();
        (new Task)->CreateAllTasksFromSchedules();
        $task = (new Task)->where('points_id', '=', $point_id)->whereNotIn('status', ['Completed', 'Cancelled'])->first();
        $this->assertEquals(carbon::now()->addDays(15)->addDays($this->DAYS_BETWEEN_TASKS_FOR_SEEDED_SCHEDULE)->toDateString(),carbon::parse($task->estimated_date)->toDateString());
    }

    public function test_class_does_not_create_default_schedule_task_for_override_point() {
        // Schedule id 3 is an override on points_id  31, set to generate 2 future tasks.
        (new Task)->CreateAllTasksFromSchedules();
        $countInstancesOfPointWithOverrideSchedule = Task::where('points_id', '=', '31')->count();
        $this->assertEquals(2, $countInstancesOfPointWithOverrideSchedule);
    }

    public function test_class_cancels_task_when_multiple_of_same_task_overdue() {
        (new Task)->CreateAllTasksFromSchedules();
        $tasks = (new Task)::where('points_id', '=', '31')->get();
        foreach($tasks as $task) {
            $task->estimated_date = carbon::now()->addDays(-60);
            $task->save();
        }
        (new Task)->CreateAllTasksFromSchedules();
        $cancelledTaskCount = Task::where('status', '=', 'Cancelled')->count();
        $this->assertEquals(1, $cancelledTaskCount);

        $overallTaskCount = Task::where('points_id', '=', 31)->count();
        $this->assertEquals(3,$overallTaskCount);
    }


}
