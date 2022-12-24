<?php

use Illuminate\Auth\GenericUser;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Test\DummyController;

beforeEach(function () {
    auth()->login(new GenericUser(['id' => 1]));
});

it('adds an item if the user has a certain ability', function () {
    assertRenders(
        '<ul><li><a href="/">Home</a></li></ul>',
        Menu::new()->addIfCan('computerSaysYes', Link::to('/', 'Home'))
    );
});

it('doesnt add an item if the user doesnt have a certain ability', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->addIfCan('computerSaysNo', Link::to('/', 'Home'))
    );
});

it('parses argument if an ability is provided as an array', function () {
    assertRenders(
        '<ul><li><a href="/">Home</a></li></ul>',
        Menu::new()->addIfCan(['computerSaysMaybe', true], Link::to('/', 'Home'))
    );

    assertRenders(
        '<ul></ul>',
        Menu::new()->addIfCan(['computerSaysMaybe', false], Link::to('/', 'Home'))
    );
});

it('adds a link if the user has a certain ability', function () {
    assertRenders(
        '<ul><li><a href="/">Home</a></li></ul>',
        Menu::new()->linkIfCan('computerSaysYes', '/', 'Home')
    );
});

it('doesnt add a link if the user doesnt have a certain ability', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->linkIfCan('computerSaysNo', '/', 'Home')
    );
});

it('adds html if the user has a certain ability', function () {
    assertRenders(
        '<ul><li><a href="/">Home</a></li></ul>',
        Menu::new()->htmlIfCan('computerSaysYes', '<a href="/">Home</a>')
    );
});

it('doesnt add html if the user doesnt have a certain ability', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->htmlIfCan('computerSaysNo', '<a href="/">Home</a>')
    );
});

it('adds a url if the user has a certain ability', function () {
    assertRenders(
        '<ul><li><a href="http://localhost">Home</a></li></ul>',
        Menu::new()->urlIfCan('computerSaysYes', '/', 'Home')
    );
});

it('doesnt add a url if the user doesnt have a certain ability', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->urlIfCan('computerSaysNo', '/', 'Home')
    );
});

it('adds an action if the user has a certain ability', function () {
    assertRenders(
        '<ul><li><a href="http://localhost">Home</a></li></ul>',
        Menu::new()->actionIfCan('computerSaysYes', DummyController::class.'@home', 'Home')
    );
});

it('doesnt add an action if the user doesnt have a certain ability', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->actionIfCan('computerSaysNo', DummyController::class.'@home', 'Home')
    );
});

it('adds a route if the user has a certain ability', function () {
    assertRenders(
        '<ul><li><a href="http://localhost">Home</a></li></ul>',
        Menu::new()->routeIfCan('computerSaysYes', 'home', 'Home')
    );
});

it('doesnt add a route if the user doesnt have a certain ability', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->routeIfCan('computerSaysNo', 'home', 'Home')
    );
});

it('adds a submenu if the user has a certain ability', function () {
    assertRenders(
        '<ul><li><a href="home">Home</a><ul><li><a href="sub">Sub</a></li></ul></li></ul>',
        Menu::new()->submenuIfCan('computerSaysYes', Link::to('home', 'Home'), Menu::new()->link('sub', 'Sub'))
    );
});

it('doesnt add a submenu if the user doesnt have a certain ability', function () {
    assertRenders(
        '<ul></ul>',
        Menu::new()->submenuIfCan('computerSaysNo', Link::to('home', 'Home'), Menu::new()->link('sub', 'Sub'))
    );
});
