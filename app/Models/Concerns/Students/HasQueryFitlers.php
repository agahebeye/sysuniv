<?php

namespace App\Models\Concerns\Students;

trait HasQueryFilters
{
    public function filterByUniversity($query)
    {
        $query->when(
            request('filter') && array_key_exists('universities.name', request('filter')),
            function (Builder $query) {
                $query->whereRelation('universities', 'users.name', request('filter')['universities.name']);
                // dump(request('filter')['universities.name']);
            }
        );
    }
}
