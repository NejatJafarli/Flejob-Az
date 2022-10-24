<?php

namespace App\QueryFilters;

use Closure;

class City extends Filter
{
    protected function applyFilter($builder)
    {
        $City = request()->get('City');
        return $builder->where('City_id', $City);
    }
}
