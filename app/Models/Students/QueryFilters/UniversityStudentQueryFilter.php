<?php
namespace App\Models\Students\QueryFilters;

class UniversityStudentQueryFilter {
     public function handle($request, Closure $next)
    {
        if ( ! request()->has('filter') && array_key_exists('universities.name', request('filter'))) {
            return $next($request);
        }

        return $next($request)->whereRelation('universities', 'users.name', request('filter')['universities.name']);
    }
}