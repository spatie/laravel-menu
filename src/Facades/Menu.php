<?php

namespace Spatie\Menu\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Menu extends Facade
{
    /**
     * @see \Spatie\Menu\Laravel\Menu
     */
    protected static function getFacadeAccessor(): string
    {
        return 'menu';
    }
}
