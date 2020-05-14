<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMappathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paths', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('category');
            $table->string('type');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->json('options')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
        Schema::create('path_coordinates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mappaths_id');
            $table->double('lat',9,6);
            $table->double('lng', 9 , 6);
            $table->integer('sequence');
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paths');
        Schema::dropIfExists('path_coordinates');
    }
}
