<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateMaintenanceRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        DB::table('maintenance_ratings')->insert([
            [   'name'=>'Comment' ],
            [   'name'=>'Cosmetic Issue' ],
            [   'name'=>'Minor Issue - needs fix within a month' ],
            [   'name'=>'Medium Issue - needs fix within two weeks' ],
            [   'name'=>'Sever Issue - needs fix with few days' ],
            [   'name'=>'Urgent Issue - needs fix same day' ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_ratings');
    }
}
