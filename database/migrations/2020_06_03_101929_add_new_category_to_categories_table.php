<?php

use App\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewCategoryToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Category::insert([
            [   'type'=>'Assets',
                'name'=>'Supplies'
            ],
            [   'type'=>'Projects',
                'name'=>'Bench'
            ],
            [   'type'=>'Projects',
                'name'=>'Erosion Control'
            ]
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

    }
}
