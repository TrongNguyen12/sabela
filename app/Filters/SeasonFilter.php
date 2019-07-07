<?php


namespace App\Filters;

class SeasonFilter
{
    public function filter($builder, $value)
    {
	    return $builder->whereHas('season',function($query) use($value){
	    	return $query->where('slug',$value);
	    });
    }
}