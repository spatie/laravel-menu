<?php

namespace Spatie\Menu\Laravel\Test;

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\View;
use Spatie\Menu\Laravel\Link;

class Issue108Test extends TestCase
{

    /**
     * @test
     * It works in 2.9, but not in 2.10 from spatie/menu
     */
    public function renderWithSpatieMenu2_10_2()
    {
        Menu::macro('admin', function () {
            $menu = Menu::new();
            $submenu = Menu::new();
            $menu->submenu(View::create('withActive', ['active' => false]), $submenu);
            return $menu;
        });
        Menu::admin()->toHtml();
        $this->assertTrue(true);
    }

}
