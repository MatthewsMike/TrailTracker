<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsInTaskEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_events', function (Blueprint $table) {
            //
            $table->dropColumn('type','type_id', 'user');
            $table->foreignId('users_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_events', function (Blueprint $table) {
            //
            if (DB::getDriverName() !== 'sqlite') { //Unit tests failing with sqlite driver
                $table->dropColumn('users_id');
                $table->foreignId('user');
                $table->enum('type', ['Point', 'Path', 'Category', 'Type']);
                $table->integer('type_id');
            }
        });
    }
}
