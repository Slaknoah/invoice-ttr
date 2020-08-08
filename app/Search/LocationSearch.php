<?php

namespace App\Search;

use App\Location;

class LocationSearch extends Searchable
{
    protected static $allowedFilters = [
        'CreatedAt',
        'UpdatedAt',
        'OrderBy',
        'Search',
        'HasRel'
    ];

    public static function returnModelInstance()
    {
        return (new Location())->newQuery();
    }
}
