<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ArchiveImage extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function add($image, $points_id, $ip, $user_id) {
        $archiveImage = ArchiveImage::firstOrNew(['image' => $image]);
        $archiveImage->points_id = $points_id;
        $archiveImage->users_id = $user_id;
        $archiveImage->ip = $ip;
        $archiveImage->save();
    }

}
