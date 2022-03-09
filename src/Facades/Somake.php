<?php

namespace Soyhuce\Somake\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Soyhuce\Somake\Somake
 */
class Somake extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-somake';
    }
}
