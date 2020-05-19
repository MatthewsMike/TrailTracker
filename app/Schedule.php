<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Schedule
 *
 * @property int $id
 * @property int $frequency_id
 * @property string $start_date
 * @property string $action
 * @property int $points
 * @property string $title
 * @property string $description
 * @property int $future_events_to_generate
 * @property int $cascade_future_tasks_on_completion
 * @property string|null $item_category
 * @property int|null $points_id
 * @property int $reward_points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereCascadeFutureTasksOnCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereFrequencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereFutureEventsToGenerate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereItemCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule wherePointsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereRewardPoints($value)
 * @mixin \Eloquent
 * @property int $categories_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereCategoriesId($value)
 */
class Schedule extends Model
{
    //
    protected $guarded = [];

    public function category() {
        return $this->hasOne('App\Category','id', 'categories_id');
    }
    public function isScheduleLocationsFromCategory () {
        return $this->item_category == null ?  false :  true;
    }

    public function isScheduleLocationsFromPoint () {
        return $this->points_id == null ?  false :  true;
    }

    public function GetAllSchedulePointsIdFromCategory() {
        //todo: convert to one to many or handle case where category is part of the name of another.
        return DB::table('points')->where('categories_id', '=',  $this->item_category)->get();
    }
}
