<?php

use App\Frequency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertDefaultFrequencyIntoFrequencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Frequency::truncate();
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

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
