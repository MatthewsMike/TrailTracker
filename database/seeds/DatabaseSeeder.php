<?php

use Illuminate\Database\Seeder;
use App\ArchiveImage;
use App\Category;
use App\Frequency;
use App\MaintenanceRating;
use App\Point;
use App\Schedule;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        ArchiveImage::insert([
            [
                'points_id' => '45',
                'image' => 'Supplies-Storage Shed - G33-1591459695.jpeg',
                'ip' => '192.168.1.1',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'
            ],            [
                'points_id' => '30',
                'image' => 'Garbage Can-Garbage Can-1590320031.jpeg',
                'ip' => '192.168.1.1',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'
            ],            [
                'points_id' => '40',
                'image' => 'Garbage Can-Garbage can city-1590345091.jpeg',
                'ip' => '192.168.1.1',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'
            ]

        ]);

        Category::insert([
            [
                'id' => '1',
                'type' => 'Feature',
                'name' => 'Parking Lot',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/1207-fac-parking.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '2',
                'type' => 'Feature',
                'name' => 'Information Board',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/1203-fac-info.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '3',
                'type' => 'Feature',
                'name' => 'Garbage Can',
                'default_icon' => 'https://anatistechnologies.com/public/images/icons/garbage-can.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '4',
                'type' => 'Feature',
                'name' => 'View',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/1399-rec-viewing-platform.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '5',
                'type' => 'Feature',
                'name' => 'Bench',
                'default_icon' => 'https://anatistechnologies.com/public/images/icons/bench.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '6',
                'type' => 'Feature',
                'name' => 'Bridge',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/1233-poi-bridge.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '7',
                'type' => 'Feature',
                'name' => 'Dog Bag Dispenser',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/965-biz-animal.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '8',
                'type' => 'Feature',
                'name' => 'Amenity',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/1087-biz-restaurant-icecream.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '9',
                'type' => 'Feature',
                'name' => 'KM Marker',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '10',
                'type' => 'Feature',
                'name' => 'Mural',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/1229-poi-art.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '11',
                'type' => 'Feature',
                'name' => 'Trail Head',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/1369-rec-hiking-trail.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '12',
                'type' => 'Feature',
                'name' => 'Gate',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '13',
                'type' => 'Maintenance',
                'name' => 'Hazardous Tree',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '14',
                'type' => 'Maintenance',
                'name' => 'Pot Hole',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '15',
                'type' => 'Maintenance',
                'name' => 'Trail Erosion',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '16',
                'type' => 'Maintenance',
                'name' => 'Trail Narrowing',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '17',
                'type' => 'Feature',
                'name' => 'Garbage Can (City)',
                'default_icon' => 'https://anatistechnologies.com/public/images/icons/garbage-can-city.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '18',
                'type' => 'Assets',
                'name' => 'Supplies',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '19',
                'type' => 'Projects',
                'name' => 'Bench',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ],            [
                'id' => '20',
                'type' => 'Projects',
                'name' => 'Erosion Control',
                'default_icon' => 'https://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png',
                'created_at' => '2020-06-06 20:08:16',
                'updated_at' => '2020-06-06 20:08:16'  
            ]
        ]

        );


        Frequency::insert([
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


        MaintenanceRating::insert([
            [   'name'=>'Comment' ],
            [   'name'=>'Cosmetic Issue' ],
            [   'name'=>'Minor Issue - needs fix within a month' ],
            [   'name'=>'Medium Issue - needs fix within two weeks' ],
            [   'name'=>'Sever Issue - needs fix with few days' ],
            [   'name'=>'Urgent Issue - needs fix same day' ]
        ]);

        Point::insert([
            [ 'id'=> '5', 'lng'=>'-63.710476', 'lat'=>'44.647076', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'360 view: https://goo.gl/maps/62jxZuttFYv'],
            [ 'id'=> '6', 'lng'=>'-63.771373', 'lat'=>'44.664475', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'360 Views:https://goo.gl/maps/RjmufwJbaJm |  https://goo.gl/maps/Y788j9wRGiN2 | https://goo.gl/maps/38NQfKAr5GT2'],
            [ 'id'=> '7', 'lng'=>'-63.744457', 'lat'=>'44.660999', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'Bench & Interpretive sign. 360 View: https://goo.gl/maps/FcWAATBr6qJ2'],
            [ 'id'=> '8', 'lng'=>'-63.709362', 'lat'=>'44.646622', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'360 View: https://goo.gl/maps/SHcZRC9piTn'],
            [ 'id'=> '9', 'lng'=>'-63.740578', 'lat'=>'44.65967', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>''],
            [ 'id'=> '10', 'lng'=>'-63.755066', 'lat'=>'44.665134', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'2 benches'],
            [ 'id'=> '11', 'lng'=>'-63.755791', 'lat'=>'44.664787', 'type'=>'Feature', 'categories_id'=>'7', 'title'=>'Dog bag dispenser.', 'description'=>''],
            [ 'id'=> '12', 'lng'=>'-63.722023', 'lat'=>'44.650891', 'type'=>'Feature', 'categories_id'=>'7', 'title'=>'Dog bag dispenser.', 'description'=>''],
            [ 'id'=> '13', 'lng'=>'-63.6891753', 'lat'=>'44.6411512', 'type'=>'Feature', 'categories_id'=>'3', 'title'=>'Garbage Can', 'description'=>''],
            [ 'id'=> '14', 'lng'=>'-63.718761', 'lat'=>'44.649628', 'type'=>'Feature', 'categories_id'=>'3', 'title'=>'Garbage can', 'description'=>''],
            [ 'id'=> '15', 'lng'=>'-63.710706', 'lat'=>'44.647139', 'type'=>'Feature', 'categories_id'=>'3', 'title'=>'Garbage can', 'description'=>''],
            [ 'id'=> '16', 'lng'=>'-63.740718', 'lat'=>'44.659771', 'type'=>'Feature', 'categories_id'=>'3', 'title'=>'Garbage Can', 'description'=>''],
            [ 'id'=> '17', 'lng'=>'-63.688632', 'lat'=>'44.641021', 'type'=>'Feature', 'categories_id'=>'1', 'title'=>'B.L.T. Trail - Parking', 'description'=>'<img src="https://lh3.googleusercontent.com/proxy/j3yJUZTD4EpEy6fmQG6LUxHL0wNzitvH4uJeNyEu-EUqPfk--gMfLRb-enm5-P6OEmFXh4Mjbt8SGz5h5i8_VUFrcjLXEMCTk3-fnrJDY7Z00XhpOeREHlug4k734jVcAM5WmvoceIYh9514ly1VpEMox83K-lQYDdkP_aM6jMnnRXOVVUZTsQzUuluHRFRmA9ZQFxbKk6J0cqG7xJsc0mzw4tDlhgLVJE4t" height="200" width="auto" /><br><br>Parking Lot next to old Coke plant. http://www.halifaxtrails.ca/index_files/BLT.htm'],
            [ 'id'=> '18', 'lng'=>'-63.76231', 'lat'=>'44.666348', 'type'=>'Feature', 'categories_id'=>'1', 'title'=>'Bluff Trail Parking', 'description'=>'Large Parking Area next to Bay Self Storage. Bluff Trail info: http://www.halifaxtrails.ca/index_files/BluffTrail.htm'],
            [ 'id'=> '19', 'lng'=>'-63.833475', 'lat'=>'44.67985', 'type'=>'Feature', 'categories_id'=>'1', 'title'=>'St. Margarets Bay Trail - Parking', 'description'=>'Small gravel parking area.'],
            [ 'id'=> '20', 'lng'=>'-63.7354285', 'lat'=>'44.6561189', 'type'=>'Feature', 'categories_id'=>'8', 'title'=>'Fitzgerald\'s Grocery', 'description'=>'<img src="https://lh3.googleusercontent.com/proxy/Vb_sXXbitxF8vT2uWhON3lhNT39XesZ-qki4YX86VUUXZK83cZEP32uyhi1UHwhvGsjn-u0TFwbETp3ZXhzEE3tQ9enI60qus50t8de8jidaLQ1aTHMuSHMxMn-7l-bnknU1HojA" height="200" width="auto" /><br><br>A really great place to stop and grab an ice cream cone or bottle of water. Locally owned and operated convenience store.'],
            [ 'id'=> '21', 'lng'=>'-63.7684746', 'lat'=>'44.6650046', 'type'=>'Feature', 'categories_id'=>'10', 'title'=>'HWY 103 Overpass Mural', 'description'=>'<img src="https://lh4.googleusercontent.com/proxy/lHB0jeoJLZuPqZvjwE4eU1HhF7wKjX0oZWRjUNZk4KVfEUqNTjG7l-jyfmcTAjLTUf7of6bvVzEFcmhgOz_CaD6a" height="200" width="auto" /><br><br>Iain Rankin on 15 Nov 2015 tweeted:<br>Great addition to the BLTTrail in #Timberlea supported by local community groups and approved by @NS_TIR #community<br>https://twitter.com/IainTRankin/status/666074138180718592'],
            [ 'id'=> '22', 'lng'=>'-63.769927', 'lat'=>'44.6647614', 'type'=>'Feature', 'categories_id'=>'11', 'title'=>'Bluff Wilderness Hiking Trail Enterance', 'description'=>'http://wrweo.ca/wp/the-bluff-trail/'],
            [ 'id'=> '23', 'lng'=>'-63.769932', 'lat'=>'44.664761', 'type'=>'Feature', 'categories_id'=>'2', 'title'=>'Bike Rack', 'description'=>'Place to lock your bike. Entrance to the Bluff Wilderness hiking trail system (http://www.halifaxtrails.ca/index_files/BluffTrail.htm)'],
            [ 'id'=> '24', 'lng'=>'-63.731912', 'lat'=>'44.655236', 'type'=>'Feature', 'categories_id'=>'6', 'title'=>'Bridge', 'description'=>'Wooden bridge and bench. 360 View: https://goo.gl/maps/oE9KwyPUt262'],
            [ 'id'=> '25', 'lng'=>'-63.7205561', 'lat'=>'44.6502896', 'type'=>'Feature', 'categories_id'=>'6', 'title'=>'Bridge', 'description'=>'small wooden bridge over a river.'],
            [ 'id'=> '26', 'lng'=>'-63.718509', 'lat'=>'44.649471', 'type'=>'Feature', 'categories_id'=>'4', 'title'=>'Six Mile Falls', 'description'=>'<img src="https://lh5.googleusercontent.com/proxy/TtlRQYX_fglYGsKewQ7MnC7OWshZ0y3zzRXVbEWMelavIl9EKqx_57FvB8eSBgSQpppuijGOIrd4bgHeaciinaJ5u4ZcWXTxwTSDElm78pWk9kENnNtnAi71VsO_FLttv-tSzKHjMxpXwk47fE2u7PbDcKw3wkJoWrjo1hpmWGILlUEIbeYeUTDU_PWtPbxhpooAZFmLenj55M2pHHpRuSYDCNXnE2TO1vM" height="200" width="auto" /><br><br>2 benches, map & garbage can. 360 View: https://goo.gl/maps/KuBDkXLrfP32'],
            [ 'id'=> '27', 'lng'=>'-63.701413', 'lat'=>'44.644304', 'type'=>'Feature', 'categories_id'=>'4', 'title'=>'Governor Lake View', 'description'=>'360 View: https://goo.gl/maps/N4vAAccwtvH2'],
            [ 'id'=> '28', 'lng'=>'-63.743808', 'lat'=>'44.660865', 'type'=>'Feature', 'categories_id'=>'9', 'title'=>'5km', 'description'=>'5km from Lakeside Entrance. 8km from St. Margarets Bay Entrance'],
            [ 'id'=> '29', 'lng'=>'-63.798487', 'lat'=>'44.67407', 'type'=>'Feature', 'categories_id'=>'9', 'title'=>'10km', 'description'=>'10km from Lakeside entrance. 3km from St. Margarets Bay entrance.'],                
            [ 'id'=> '30', 'lng'=>'-63.798487', 'lat'=>'44.68407', 'type'=>'Maintenance', 'categories_id'=>'14', 'title'=>'10km', 'description'=>'10km from Lakeside entrance. 3km from St. Margarets Bay entrance.']                
        ]);

        Schedule::Insert([
            [
                'frequency_id' => '4',
                'start_date' => '2020-05-01',
                'action' => 'Work Item',
                'points_id' => null,
                'categories_id' => '3',
                'reward_points' => '10',
                'title' => 'Empty Garbage',
                'description' => 'Empty Garbage',
                'future_events_to_generate' => '1',
                'cascade_future_tasks_on_completion' => '1'
            ],            [
                'frequency_id' => '3',
                'start_date' => '2020-05-01',
                'action' => 'Work Item',
                'points_id' => '30',
                'categories_id' => null,
                'reward_points' => '15',
                'title' => 'Empty Garbage',
                'description' => 'Empty Garbage',
                'future_events_to_generate' => '1',
                'cascade_future_tasks_on_completion' => '1'
            ],
        ]);
    }
}
