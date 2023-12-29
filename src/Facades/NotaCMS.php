<?php

namespace Azzarip\NotaCMS\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Azzarip\NotaCMS\NotaCMS
 */
class NotaCMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Azzarip\NotaCMS\NotaCMS::class;
    }
}
