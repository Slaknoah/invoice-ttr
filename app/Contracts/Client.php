<?php

namespace App\Contracts;

interface Client
{
    public function __call($method, $parameters);
}