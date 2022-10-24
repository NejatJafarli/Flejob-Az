<?php

namespace App\QueryFilters;

use Closure;

class Category extends Filter
{
    protected function applyFilter($builder)
    {
        $City = request()->get('Category');
        return $builder->where('Category_id', $City);
    }
}
