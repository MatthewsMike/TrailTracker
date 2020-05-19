<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertDefaultPointsIntoPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('points', function (Blueprint $table) {
            $table->text('description')->change();
        });
        //
        DB::table('points')->insert( [ 'lng'=>'-63.710476', 'lat'=>'44.647076', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'360 view: https://goo.gl/maps/62jxZuttFYv',]);
        DB::table('points')->insert( [ 'lng'=>'-63.771373', 'lat'=>'44.664475', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'360 Views:https://goo.gl/maps/RjmufwJbaJm |  https://goo.gl/maps/Y788j9wRGiN2 | https://goo.gl/maps/38NQfKAr5GT2',]);
        DB::table('points')->insert( [ 'lng'=>'-63.744457', 'lat'=>'44.660999', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'Bench & Interpretive sign. 360 View: https://goo.gl/maps/FcWAATBr6qJ2',]);
        DB::table('points')->insert( [ 'lng'=>'-63.709362', 'lat'=>'44.646622', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'360 View: https://goo.gl/maps/SHcZRC9piTn',]);
        DB::table('points')->insert( [ 'lng'=>'-63.740578', 'lat'=>'44.65967', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'',]);
        DB::table('points')->insert( [ 'lng'=>'-63.755066', 'lat'=>'44.665134', 'type'=>'Feature', 'categories_id'=>'5', 'title'=>'Bench', 'description'=>'2 benches',]);
        DB::table('points')->insert( [ 'lng'=>'-63.755791', 'lat'=>'44.664787', 'type'=>'Feature', 'categories_id'=>'7', 'title'=>'Dog bag dispenser.', 'description'=>'',]);
        DB::table('points')->insert( [ 'lng'=>'-63.722023', 'lat'=>'44.650891', 'type'=>'Feature', 'categories_id'=>'7', 'title'=>'Dog bag dispenser.', 'description'=>'',]);
        DB::table('points')->insert( [ 'lng'=>'-63.6891753', 'lat'=>'44.6411512', 'type'=>'Feature', 'categories_id'=>'3', 'title'=>'Garbage Can', 'description'=>'',]);
        DB::table('points')->insert( [ 'lng'=>'-63.718761', 'lat'=>'44.649628', 'type'=>'Feature', 'categories_id'=>'3', 'title'=>'Garbage can', 'description'=>'',]);
        DB::table('points')->insert( [ 'lng'=>'-63.710706', 'lat'=>'44.647139', 'type'=>'Feature', 'categories_id'=>'3', 'title'=>'Garbage can', 'description'=>'',]);
        DB::table('points')->insert( [ 'lng'=>'-63.740718', 'lat'=>'44.659771', 'type'=>'Feature', 'categories_id'=>'3', 'title'=>'Garbage Can', 'description'=>'',]);
        DB::table('points')->insert( [ 'lng'=>'-63.688632', 'lat'=>'44.641021', 'type'=>'Feature', 'categories_id'=>'1', 'title'=>'B.L.T. Trail - Parking', 'description'=>'<img src="https://lh3.googleusercontent.com/proxy/j3yJUZTD4EpEy6fmQG6LUxHL0wNzitvH4uJeNyEu-EUqPfk--gMfLRb-enm5-P6OEmFXh4Mjbt8SGz5h5i8_VUFrcjLXEMCTk3-fnrJDY7Z00XhpOeREHlug4k734jVcAM5WmvoceIYh9514ly1VpEMox83K-lQYDdkP_aM6jMnnRXOVVUZTsQzUuluHRFRmA9ZQFxbKk6J0cqG7xJsc0mzw4tDlhgLVJE4t" height="200" width="auto" /><br><br>Parking Lot next to old Coke plant. http://www.halifaxtrails.ca/index_files/BLT.htm',]);
        DB::table('points')->insert( [ 'lng'=>'-63.76231', 'lat'=>'44.666348', 'type'=>'Feature', 'categories_id'=>'1', 'title'=>'Bluff Trail Parking', 'description'=>'Large Parking Area next to Bay Self Storage. Bluff Trail info: http://www.halifaxtrails.ca/index_files/BluffTrail.htm',]);
        DB::table('points')->insert( [ 'lng'=>'-63.833475', 'lat'=>'44.67985', 'type'=>'Feature', 'categories_id'=>'1', 'title'=>'St. Margarets Bay Trail - Parking', 'description'=>'Small gravel parking area.',]);
        DB::table('points')->insert( [ 'lng'=>'-63.7354285', 'lat'=>'44.6561189', 'type'=>'Feature', 'categories_id'=>'8', 'title'=>'Fitzgerald\'s Grocery', 'description'=>'<img src="https://lh3.googleusercontent.com/proxy/Vb_sXXbitxF8vT2uWhON3lhNT39XesZ-qki4YX86VUUXZK83cZEP32uyhi1UHwhvGsjn-u0TFwbETp3ZXhzEE3tQ9enI60qus50t8de8jidaLQ1aTHMuSHMxMn-7l-bnknU1HojA" height="200" width="auto" /><br><br>A really great place to stop and grab an ice cream cone or bottle of water. Locally owned and operated convenience store.',]);
        DB::table('points')->insert( [ 'lng'=>'-63.7684746', 'lat'=>'44.6650046', 'type'=>'Feature', 'categories_id'=>'10', 'title'=>'HWY 103 Overpass Mural', 'description'=>'<img src="https://lh4.googleusercontent.com/proxy/lHB0jeoJLZuPqZvjwE4eU1HhF7wKjX0oZWRjUNZk4KVfEUqNTjG7l-jyfmcTAjLTUf7of6bvVzEFcmhgOz_CaD6a" height="200" width="auto" /><br><br>Iain Rankin on 15 Nov 2015 tweeted:<br>Great addition to the BLTTrail in #Timberlea supported by local community groups and approved by @NS_TIR #community<br>https://twitter.com/IainTRankin/status/666074138180718592',]);
        DB::table('points')->insert( [ 'lng'=>'-63.769927', 'lat'=>'44.6647614', 'type'=>'Feature', 'categories_id'=>'11', 'title'=>'Bluff Wilderness Hiking Trail Enterance', 'description'=>'http://wrweo.ca/wp/the-bluff-trail/',]);
        DB::table('points')->insert( [ 'lng'=>'-63.769932', 'lat'=>'44.664761', 'type'=>'Feature', 'categories_id'=>'2', 'title'=>'Bike Rack', 'description'=>'Place to lock your bike. Entrance to the Bluff Wilderness hiking trail system (http://www.halifaxtrails.ca/index_files/BluffTrail.htm)',]);
        DB::table('points')->insert( [ 'lng'=>'-63.731912', 'lat'=>'44.655236', 'type'=>'Feature', 'categories_id'=>'6', 'title'=>'Bridge', 'description'=>'Wooden bridge and bench. 360 View: https://goo.gl/maps/oE9KwyPUt262',]);
        DB::table('points')->insert( [ 'lng'=>'-63.7205561', 'lat'=>'44.6502896', 'type'=>'Feature', 'categories_id'=>'6', 'title'=>'Bridge', 'description'=>'small wooden bridge over a river.',]);
        DB::table('points')->insert( [ 'lng'=>'-63.718509', 'lat'=>'44.649471', 'type'=>'Feature', 'categories_id'=>'4', 'title'=>'Six Mile Falls', 'description'=>'<img src="https://lh5.googleusercontent.com/proxy/TtlRQYX_fglYGsKewQ7MnC7OWshZ0y3zzRXVbEWMelavIl9EKqx_57FvB8eSBgSQpppuijGOIrd4bgHeaciinaJ5u4ZcWXTxwTSDElm78pWk9kENnNtnAi71VsO_FLttv-tSzKHjMxpXwk47fE2u7PbDcKw3wkJoWrjo1hpmWGILlUEIbeYeUTDU_PWtPbxhpooAZFmLenj55M2pHHpRuSYDCNXnE2TO1vM" height="200" width="auto" /><br><br>2 benches, map & garbage can. 360 View: https://goo.gl/maps/KuBDkXLrfP32',]);
        DB::table('points')->insert( [ 'lng'=>'-63.701413', 'lat'=>'44.644304', 'type'=>'Feature', 'categories_id'=>'4', 'title'=>'Governor Lake View', 'description'=>'360 View: https://goo.gl/maps/N4vAAccwtvH2',]);
        DB::table('points')->insert( [ 'lng'=>'-63.743808', 'lat'=>'44.660865', 'type'=>'Feature', 'categories_id'=>'9', 'title'=>'5km', 'description'=>'5km from Lakeside Entrance. 8km from St. Margarets Bay Entrance',]);
        DB::table('points')->insert( [ 'lng'=>'-63.798487', 'lat'=>'44.67407', 'type'=>'Feature', 'categories_id'=>'9', 'title'=>'10km', 'description'=>'10km from Lakeside entrance. 3km from St. Margarets Bay entrance.',]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('points', function (Blueprint $table) {
            $table->string('description')->change();
        });
    }
}
