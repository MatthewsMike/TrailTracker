<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
/**
 * Task
 *
 * @mixin Builder
 * @property int $id
 * @property string|null $address
 * @property float $lat
 * @property float $lng
 * @property string $category
 * @property string $type
 * @property string $title
 * @property string|null $description
 * @property string|null $icon
 * @property string|null $url
 * @property mixed|null $options
 * @property int|null $ApprovedBy
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereUrl($value)
 */
class Point extends Model
{
    //
    protected $guarded = ['isApproved'];

}
