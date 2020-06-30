<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPointEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {      
        Schema::create('point_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('points_id');
            $table->string('type');
            $table->string('notes');
            $table->dateTime('event_occurred_at');
            $table->foreignId('users_id')->nullable();
            $table->string('ip')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_events');
    }
}
