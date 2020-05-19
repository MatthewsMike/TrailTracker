<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnItemCategoryInSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->foreignId('categories_id');
        });

        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('item_category');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            //
            Schema::table('schedules', function (Blueprint $table) {
                $table->string('item_category');
            });

            Schema::table('schedules', function (Blueprint $table) {
                $table->dropColumn('categories_id');
            });
        });
    }
}
