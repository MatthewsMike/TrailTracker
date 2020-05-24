<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Frequency
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Frequency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Frequency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Frequency query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $duration_in_days
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Frequency whereDurationInDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Frequency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Frequency whereName($value)
 */
class Frequency extends Model
{
    //
    protected $guarded = [];
    protected $table = 'frequency';

    public function getAllFrequenciesAndId() {
        return DB::table('frequency')->pluck('name','id');
    }
}
