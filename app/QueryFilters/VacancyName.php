<?php

namespace App\QueryFilters;

use Closure;

class VacancyName extends Filter
{
    protected function applyFilter($builder)
    {
        $name = request()->get('VacancyName');
        return $builder->where('VacancyName', 'like', '%'.$name.'%');
    }
}
