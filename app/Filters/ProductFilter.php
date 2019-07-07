<?php

// ProductFilter.php

namespace App\Filters;


class ProductFilter extends AbstractFilter
{
    protected $filters = [
        'material'=>MaterialFilter::class,
        'size'=>SizeFilter::class,
        'season'=>SeasonFilter::class,
        'cat' => CategoryFilter::class,
    ];
}