<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function flavour()
    {
        return $this->belongsTo(Flavour::class, 'flavour_id', 'id');
    }
}
