<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'vn_province';

    public function district(){
        return $this->hasMany('App\District','provinceid','provinceid');
    }

    public function customer(){
        return $this->hasMany('App\Customer','province_id','provinceid');
    }
}
