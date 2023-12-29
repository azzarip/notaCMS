<?php

namespace azzarip\NotaCMS\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \azzarip\NotaCMS\NotaCMS
 */
class NotaCMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \azzarip\NotaCMS\NotaCMS::class;
    }
}
