<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $guarded = [];
    protected $table = 'categories';
    //
    public function getAllCategoryTypes() {
        return DB::table('categories')->distinct()->pluck('type');
    }
}
