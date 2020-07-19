<?php

namespace App\Search\Filters;

class IsVerified implements Filter
{
    public static function apply($builder, $value)
    {
        if($value == 'yes') {
            return $builder->where('email_verified_at', '!=', null);
        } else if($value == 'no') {
            return $builder->whereNull('email_verified_at');
        }
    }
}