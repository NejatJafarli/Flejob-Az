<?php

namespace App\QueryFilters;

abstract class Filter
{
    protected abstract function applyFilter($builder);

    public function handle($request, \Closure $next)
    {
        $classname = class_basename($this);

        $filter = request()->get($classname);
        if ($filter === null || $filter == 'All')
            return $next($request);

        $builder = $next($request);
        return $this->applyFilter($builder);
    }
}
