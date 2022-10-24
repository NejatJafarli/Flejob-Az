<?php

namespace App\QueryFilters;

use Closure;

class Company extends Filter
{
    protected function applyFilter($builder)
    {
        $Company = request()->get('Company');
        return $builder->where('CompanyUser_id', $Company);
    }
}
