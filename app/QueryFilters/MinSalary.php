<?php

namespace App\QueryFilters;

use Closure;

class MinSalary extends Filter
{
    protected function applyFilter($builder)
    {
        $min= (int)request()->get('MinSalary');
        return $builder->where('VacancySalary', '>=', $min);
    }
}
