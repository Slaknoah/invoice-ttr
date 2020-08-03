<?php

namespace App\Search;

use App\Tourist;

class TouristSearch extends Searchable
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
        return (new Tourist())->newQuery();
    }
}
