<?php

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

it('can set items active based on the current request', function () {
    $this->call('get', '/post/1');

    $menu = Menu::new()
        ->add(Link::toRoute('home', 'Home'))
        ->add(Link::toRoute('post', 'Post #1', [1]))
        ->setActiveFromRequest();

    assertRenders(
        '<ul>
        <li><a href="http://localhost">Home</a></li>
        <li class="active exact-active"><a href="http://localhost/post/1">Post #1</a></li>
        </ul>',
        $menu
    );
});
