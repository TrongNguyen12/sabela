<?php


namespace App\Filters;

class MaterialFilter
{
    public function filter($builder, $value)
    {
	    return $builder->whereHas('material',function($query) use($value){
	    	return $query->where('slug',$value);
	    });
    }
}