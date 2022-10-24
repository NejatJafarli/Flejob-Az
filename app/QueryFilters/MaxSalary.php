<?php

namespace App\QueryFilters;

use Closure;

class MaxSalary extends Filter
{
    protected function applyFilter($builder)
    {
        $max= (int)request()->get('MaxSalary');
        return $builder->where('VacancySalary', '<=', $max);
    }
}
