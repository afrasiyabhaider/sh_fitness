<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flavour extends Model
{
    use SoftDeletes;

    public function product_flavours()
    {
        return $this->hasMany(ProductSize::class, 'id', 'flavour_id');
    }
}
