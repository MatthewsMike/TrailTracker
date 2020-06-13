<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Task
 *
 * @mixin Builder
 * @property int $id
 * @property string|null $address
 * @property float $lat
 * @property float $lng
 * @property string $type
 * @property string $title
 * @property string|null $description
 * @property string|null $icon
 * @property string|null $url
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
 * @property int $categories_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereCategoriesId($value)
 * @property string $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Point whereImage($value)
 */
class Point extends Model
{
    //
    use SoftDeletes;
    protected $guarded = ['isApproved'];

    public function category() {
        return $this->hasOne('App\Category','id', 'categories_id');
    }

    public function maintenanceRating() {
        return $this->hasOne('App\MaintenanceRating','id', 'maintenance_rating');
    }

    public function getAllPointsByType($type = 'Feature') {
        if($type == 'All') return (new \App\Point)->with('category')->get();
        else return (new \App\Point)->with('category')->where('type', '=', $type)->get();
    }

    public function verifyAllImagesResizedForMapCard() {
        $points = (new Point)->where('image', '!=', '');
        foreach($points as $point) {
            if($point->isValidImagePresent()) {
                $point->resizeImageForMapCard();
            }
        }
    }

    private function isValidImagePresent() {
        if(is_file(public_path(env('PATH_TO_IMAGES')  .$this->image)))  {
            return true;
        } else {
            return false;
        }
    }

    private function isMapCardImageCreated() {
        if(is_file(public_path(env('PATH_TO_IMAGES_MAP_CARD'). $this->image))) {
            return true;
        }
        return false;
    }

    public function resizeImageForMapCard($force = false) {
        if($this->isValidImagePresent() && (!$this->isMapCardImageCreated() || $force)) {    
            Image::make(public_path(env('PATH_TO_IMAGES') . $this->image))
            ->resize(300, null, function ($constraint) {$constraint->aspectRatio();})
            ->orientate()
            ->save(public_path(env('PATH_TO_IMAGES_MAP_CARD') . $this->image));
        }
    }
}
