<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MaintenanceRating extends Model
{
    //
    public function getAllAsArray() {
        return DB::table('maintenance_ratings')->pluck('name','id');
    }
}
