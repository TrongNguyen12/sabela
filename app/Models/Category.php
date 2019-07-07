<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $table = 'category';
     public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'product_category', 'id_category', 'id_product');
    }
}
