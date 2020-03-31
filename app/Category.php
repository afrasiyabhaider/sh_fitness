<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function sub_categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent_category()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }
}
