<?php

namespace Dealskoo\Billing\Facades;

use Illuminate\Support\Facades\Facade;

class Price extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'price';
    }
}
