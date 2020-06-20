<?php

namespace App\Search;

use App\User;

class UserSearch extends Searchable
{
    protected static $allowedFilters = [
        'Role',
        'IsVerified',
        'CreatedAt',
        'UpdatedAt',
        'OrderBy'
    ];

    public static function returnModelInstance()
    {
        return (new User)->newQuery();
    }
}
