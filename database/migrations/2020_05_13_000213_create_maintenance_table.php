<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('skill');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('frequency', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('duration_in_days');
        });

        DB::table('frequency')->insert([
            [   'name'=>'daily',
                'duration_in_days'=>'1' ],
            [   'name'=>'weekly',
                'duration_in_days'=>'7' ],
            [   'name'=>'biweekly',
                'duration_in_days'=>'14' ],
            [   'name'=>'monthly',
                'duration_in_days'=>'30' ],
            [   'name'=>'bimonthly',
                'duration_in_days'=>'60' ],
            [   'name'=>'seasonally',
                'duration_in_days'=>'90' ],
            [   'name'=>'semiannually',
                'duration_in_days'=>'180' ],
            [   'name'=>'yearly',
                'duration_in_days'=>'365' ],
            [   'name'=>'every 2 years',
                'duration_in_days'=>'730' ],
            [   'name'=>'every 5 years',
                'duration_in_days'=>'1826' ],
            [   'name'=>'every 10 years',
                'duration_in_days'=>'3652' ]
        ]);

        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frequency_id');
            $table->date('start_date');
            $table->enum('action',['Inspection','Work Item']);
            $table->string('item_category')->nullable();
            $table->foreignId('points_id')->nullable();
            $table->integer('reward_points');
            $table->string('title');
            $table->string('description');
            $table->integer('future_events_to_generate')->default(1);
            $table->boolean('cascade_future_tasks_on_completion')->default(true);
            $table->timestamps();
        });

        Schema::create('schedule_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id');
            $table->foreignId('requirements_id');
        });

        Schema::create('schedule_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id');
            $table->foreignId('skills_id');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id');
            $table->foreignId('points_id');
            $table->enum('status', ['Future', 'Unassigned', 'Overdue', 'Assigned', 'In Progress', 'Completed', 'Cancelled']);
            $table->integer('type_id');
            $table->date('estimated_date');
            $table->timestamps();
        });

        Schema::create('task_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tasks_id');
            $table->string('notes');
            $table->dateTime('event_occurred_at');
            $table->foreignId('user');
            $table->enum('type', ['Point', 'Path', 'Category', 'Type']);
            $table->integer('type_id');
        });


        DB::table('schedules')->insert(
            [
                'frequency_id'=>'1',
                'start_date'=>'2020-05-01',
                'action'=>'Work Item',
                'item_category'=>'Member',
                'points_id'=>null,
                'reward_points'=>10,
                'title'=>'Test Schedule',
                'description'=>'Test Schedule Description',
                'future_events_to_generate'=>3,
                'cascade_future_tasks_on_completion'=>true
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills');
        Schema::dropIfExists('frequency');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('requirements');
        Schema::dropIfExists('schedule_requirements');
        Schema::dropIfExists('schedule_skills');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_events');
    }
}
