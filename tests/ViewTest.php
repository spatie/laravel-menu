<?php

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\View;

it('can render a simple view', function () {
    assertRenders('Hello, menu!', View::create('simple'));
});

it('receives an active variable', function () {
    assertRenders('I\'m active', View::create('withActive')->setActive());
    assertRenders('I\'m inactive', View::create('withActive')->setInactive());
});

it('can receive extra data', function () {
    assertRenders('Hello, Sebastian!', View::create('withData', ['name' => 'Sebastian']));
});

it('can receive a url through extra data', function () {
    $menu = Menu::new()
        ->view('simple', ['url' => '/'])
        ->view('simple', ['url' => '/about']);

    assertRenders("
        <ul>
        <li>Hello, menu!\n</li>
        <li>Hello, menu!\n</li>
        </ul>
    ", $menu);
});
