<?php

namespace App\Search\Filters;

class Role implements Filter
{
    public static function apply($builder, $value)
    {
        return $builder->where('role_id', $value);
    }
}