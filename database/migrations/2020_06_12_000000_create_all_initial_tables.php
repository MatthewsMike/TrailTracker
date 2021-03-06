<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAllInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('points_id');
            $table->string('image');
            $table->foreignId('users_id')->nullable();
            $table->string('ip')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('default_icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
 
        Schema::create('frequency', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('duration_in_days');
        });

        Schema::create('maintenance_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->double('lat',9,6);
            $table->double('lng',9,6);
            $table->string('type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->integer('maintenance_rating')->nullable();
            $table->foreignId('categories_id')->nullable();
            $table->foreignId('ApprovedBy')->nullable()->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

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
            $table->foreignId('categories_id')->nullable();
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

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('skill');
            $table->string('description');
            $table->timestamps();
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
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archive_images');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('frequency');
        Schema::dropIfExists('maintenance_ratings');
        Schema::dropIfExists('points');
        Schema::dropIfExists('requirements');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('schedule_requirements');
        Schema::dropIfExists('schedule_skills');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_events');
    }
}
