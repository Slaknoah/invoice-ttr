<?php

namespace App\Search\Filters;

class Price implements Filter
{
    public static function apply($builder, $value)
    {
        if (is_array($value))
            return $builder->whereBetween('price', [$value['from'], $value['to']]);
        else
            return $builder->where('price', $value);

    }
}