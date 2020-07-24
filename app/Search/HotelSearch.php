<?php

namespace App\Search;

use App\Hotel;

class HotelSearch extends Searchable
{
    protected static $allowedFilters = [
        'CreatedAt',
        'UpdatedAt',
        'OrderBy',
        'Search'
    ];

    public static function returnModelInstance()
    {
        return (new Hotel())->newQuery();
    }
}
