<?php

namespace App\Search\Filters;

class WhereAnd implements Filter
{
    public static function apply($builder, $value)
    {
        return $builder->whereAnd( $value );
    }
}