<?php

namespace App\Search;

use App\HotelReservation;

class HotelReservationSearch extends Searchable
{
    protected static $allowedFilters = [
        'HotelStatus',
        'Order',
        'Hotel',
        'CreatedAt',
        'UpdatedAt',
        'DateStart',
        'DateEnd',
        'Price',
        'OrderBy'
    ];

    public static function returnModelInstance()
    {
        return (new HotelReservation())->newQuery();
    }
}
