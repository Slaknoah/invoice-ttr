<?php

namespace App\Search\Filters;

class Hotel implements Filter
{
    public static function apply($builder, $value)
    {
        if( is_array($value) ) return $builder->whereIn('hotel_id', $value);

        return $builder->where('hotel_id', $value);
    }
}