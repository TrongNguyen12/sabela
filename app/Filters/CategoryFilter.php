<?php


namespace App\Filters;

class CategoryFilter
{
    public function filter($builder, $value)
    {
	    return $builder->whereHas('category',function($query) use($value){
	    	return $query->where('category_id',$value);
	    });
    }
}