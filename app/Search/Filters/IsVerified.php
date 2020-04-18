<?php

namespace App\Search\Filters;

class IsVerified implements Filter
{
    public static function apply($builder, $value)
    {
        return $builder->where('email_verified_at', '!=', null);
    }
}