<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table = 'vn_district';

    public function province(){
        return $this->belongsTo('App\Province','provinceid','districtid');
    }

    public function customer(){
        return $this->hasMany('App\Customer','district_id','districtid');
    }
}
