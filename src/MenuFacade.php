<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Facades\Facade;

class MenuFacade extends Facade
{
    /**
     * @see \Spatie\Menu\Laravel\Menu
     */
    protected static function getFacadeAccessor() : string
    {
        return 'menu';
    }
}
