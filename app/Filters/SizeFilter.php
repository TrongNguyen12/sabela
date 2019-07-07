<?php


namespace App\Filters;

class SizeFilter
{
    public function filter($builder, $value)
    {
	    return $builder->whereHas('size',function($query) use($value){
	    	return $query->where('slug',$value);
	    });
    }
}