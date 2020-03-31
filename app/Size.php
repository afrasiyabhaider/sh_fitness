<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use SoftDeletes;

    public function product_sizes()
    {
        return $this->hasMany(ProductSize::class, 'id', 'size_id');
    }
}
