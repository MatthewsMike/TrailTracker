<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Category
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string|null $default_icon
 * @property string|null $description
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDefaultIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereType($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $guarded = [];
    protected $table = 'categories';
    //
    public function getAllCategoryTypes() {
        return DB::table('categories')->distinct()->pluck('type');
    }

    public function getCategoriesAndIdByType($type) {
        return DB::table('categories')->where('type', '=', $type)->pluck('name','id');
    }
}
