<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('points', function (Blueprint $table) {
            //
            $table->foreignId('categories_id');
        });
        DB::table('points')->join('categories', 'points.categories','=','categories.name')
            ->update(['points.categories_id' => db::raw("`categories`.`id`")]);

        Schema::table('points', function (Blueprint $table) {
            $table->dropColumn('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('points', function (Blueprint $table) {
            //
            $table->string('categories');
            $table->dropColumn('categories_id');
        });
    }
}
