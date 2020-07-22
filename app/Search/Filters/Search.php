<?php

namespace App\Search\Filters;


class Search implements Filter
{
    public static function apply($builder, $value)
    {
        if (is_array($value)) {
            return $builder->whereLike($value['field'], $value['query']);
        }
    }
}