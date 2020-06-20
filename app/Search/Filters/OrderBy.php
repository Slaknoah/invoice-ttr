<?php

namespace App\Search\Filters;

class OrderBy implements Filter
{
    public static function apply($builder, $value)
    {
        if (is_array($value)) {
            return $builder->orderBy($value[0], $value[1]);
        }
        return $builder->orderBy($value, 'asc');
    }
}