<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMappointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();;
            $table->double('lat',9,6);
            $table->double('lng',9,6);
            $table->string('categories')->nullable();
            $table->string('type');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->json('options')->nullable();
            $table->unsignedBigInteger('ApprovedBy')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('points', function (Blueprint $table) {
            $table->foreign('ApprovedBy')->references('id')->on('users');
        });



        DB::table('points')->insertGetId(
            [
                'address'=>'Home',
                'lat'=>'44.6556',
                'lng'=>'-63.733811',
                'type'=>'House',
                'categories'=>'Member',
                'title'=>'Test House',
                'description'=>'This is my home',
                'url'=>'http://blttrails.ca',
            ]
        );


        DB::table('points')->insertGetId(
            [
                'address'=>'Home2',
                'lat'=>'44.756',
                'categories' => 'Member,Member2',
                'lng'=>'-63.8811',
                'type'=>'House',
                'title'=>'Test House2',
                'description'=>'This is my home2',
                'url'=>'http://blttrails.ca',
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
        Schema::dropIfExists('points');

    }
}
