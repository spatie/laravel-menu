<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Menu::class, Menu::class);
        $this->app->alias(Menu::class, 'menu');
    }
}
