<?php

namespace App\Search\Filters;

class Role implements Filter
{
    public static function apply($builder, $value)
    {
        if (is_array($value)) return $builder->whereIn('role_id', $value);

        return $builder->where('role_id', $value);
    }
}