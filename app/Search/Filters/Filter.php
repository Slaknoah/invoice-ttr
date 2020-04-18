<?php

namespace App\Search\Filters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    /**
     * Apply a given search value  to a builder instance
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */

    public static function apply(Builder $builder, $value);
}