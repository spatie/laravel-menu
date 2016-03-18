<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Menu::class, function () {
            return Menu::new();
        });

        $this->app->alias(Menu::class, 'menu');
    }
}
