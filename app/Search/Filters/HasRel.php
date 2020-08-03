<?php

namespace App\Search\Filters;


use Illuminate\Support\Arr;

class HasRel implements Filter
{
    public static function apply($builder, $value)
    {
        if (is_array($value)) {
            if (is_array($value['ids'])) {
                return $builder->whereHas($value['rel'], function ($query) use ($value) {
                    $ids = [];

                    foreach (Arr::wrap($value['ids']) as $id) {
                        $ids[] = intval($id);
                    }
                    $query->whereIn($value['rel'] . ".id", $ids);
                });
            } else {
                return $builder->whereHas($value['rel'], function ($query) use ($value) {
                    $query->where($value['rel'] . ".id", json_decode($value['ids']));
                });
            }
        }
    }
}