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
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    protected $EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED;
    protected $CATEGORIES_ID_OF_DEFAULT_SCHEDULE;
 
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->EXPECTED_TASKS_FROM_INITIAL_DATABASE_SEED = 5;
        $this->CATEGORIES_ID_OF_DEFAULT_SCHEDULE = 3;
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

    public function test_class_cascades_when_required_for_next_task()
    {
        // TODO Write Test
        
    }

    public function test_class_does_not_cascades_when_not_required_for_next_task()
    {
        // TODO Write Test
        
    }

    public function test_class_does_not_create_default_schedule_task_for_override_point() {
        // TODO Write Test

    }

    public function test_class_cancels_task_when_multiple_of_same_task_overdue() {
        // TODO Write Test
        
    }

    public function test_class_adds_event_log_for_any_cancelled_tasks() {
        // TODO Write Test
        
    }
}
