<?php

namespace App\Search\Filters;

class WhereOr implements Filter
{
    public static function apply($builder, $value)
    {
        return $builder->whereOr( $value );
    }
}