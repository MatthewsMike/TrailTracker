<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('description')->nullable();
            $table->softDeletes();
        });

        DB::table('categories')->insert([
            [
                'type'=>'Feature',
                'name'=>'Parking Lot',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1207-fac-parking.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Information Board',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1203-fac-info.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Garbage Can',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1071-biz-pub.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'View',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1399-rec-viewing-platform.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Bench',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1381-rec-picnic.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Bridge',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1233-poi-bridge.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Dog Bag Dispenser',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/965-biz-animal.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Amenity',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1087-biz-restaurant-icecream.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'KM Marker',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Mural',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1229-poi-art.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Trail',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/1369-rec-hiking-trail.png',
                'description' => '',
            ],
            [
                'type'=>'Feature',
                'name'=>'Gate',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'description' => '',
            ],
            [
                'type'=>'Maintenance',
                'name'=>'Hazardous Tree',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'description' => '',
            ],
            [
                'type'=>'Maintenance',
                'name'=>'Pot Hole',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'description' => '',
            ],
            [
                'type'=>'Maintenance',
                'name'=>'Trail Erosion',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'description' => '',
            ],
            [
                'type'=>'Maintenance',
                'name'=>'Trail Narrowing',
                'icon'=>'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'description' => '',
            ]
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
