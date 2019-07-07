<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'product_category', 'id_product', 'id_category');
    }
}
