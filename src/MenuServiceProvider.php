<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Menu;

class MenuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Menu::class);
        $this->app->alias(Menu::class, 'menu');
    }
}
