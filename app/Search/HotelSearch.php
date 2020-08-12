<?php

namespace App\Search;

use App\Hotel;

class HotelSearch extends Searchable
{
    protected static $allowedFilters = [
        'CreatedAt',
        'UpdatedAt',
        'OrderBy',
        'Search',
        'WhereAnd',
        'HasRel'
    ];

    public static function returnModelInstance()
    {
        return (new Hotel())->newQuery();
    }
}
