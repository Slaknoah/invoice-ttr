<?php

namespace App\Search\Filters;

class Order implements Filter
{
    public static function apply($builder, $value)
    {
        if( is_array($value) ) return $builder->whereIn('order_id', $value);

        return $builder->where('order_id', $value);
    }
}