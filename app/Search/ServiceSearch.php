<?php

namespace App\Search;

use App\Service;

class ServiceSearch extends Searchable
{
    protected static $allowedFilters = [
        'CreatedAt',
        'UpdatedAt',
        'OrderBy',
        'Search'
    ];

    public static function returnModelInstance()
    {
        return (new Service())->newQuery();
    }
}
