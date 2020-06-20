<?php


namespace App\Search\Filters;

class HotelStatus implements Filter
{
    public static function apply($builder, $value)
    {
        if ( is_array($value) ) return $builder->whereIn('hotel_status_id', $value);

        return $builder->where('hotel_status_id', $value);
    }
}