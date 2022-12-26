<?php

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Test\DummyController;

it('adds a url if the condition is true', function () {
    assertRenders(
        '<ul><li><a href="http://localhost">Home</a></li></ul>',
        Menu::new()->urlIf(true, '/', 'Home')
    );
});

it('doesnt add a url if the condition isnt true', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->urlIf(false, '/', 'Home')
    );
});

it('adds an action if the condition is true', function () {
    assertRenders(
        '<ul><li><a href="http://localhost">Home</a></li></ul>',
        Menu::new()->actionIf(true, DummyController::class.'@home', 'Home')
    );
});

it('doesnt add an action if the condition isnt true', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->actionIf(false, DummyController::class.'@home', 'Home')
    );
});

it('adds a route if the condition is true', function () {
    assertRenders(
        '<ul><li><a href="http://localhost">Home</a></li></ul>',
        Menu::new()->routeIf(true, 'home', 'Home')
    );
});

it('doesnt add a route if the condition isnt true', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->routeIf(false, 'home', 'Home')
    );
});
