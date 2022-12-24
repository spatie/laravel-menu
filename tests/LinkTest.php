<?php

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Test\DummyController;

it('can be created for a url', function () {
    assertRenders(
        '<a href="http://localhost">Home</a>',
        Link::toUrl('/', 'Home')
    );
});

it('can be created for a url with parameters', function () {
    assertRenders(
        '<a href="http://localhost/post/1">Post #1</a>',
        Link::toUrl('post', 'Post #1', ['id' => 1])
    );
});

it('can be created for a route', function () {
    assertRenders(
        '<a href="http://localhost">Home</a>',
        Link::toRoute('home', 'Home')
    );
});

it('can be created for a route with parameters', function () {
    assertRenders(
        '<a href="http://localhost/post/1">Post #1</a>',
        Link::toRoute('post', 'Post #1', ['id' => 1])
    );
});

it('can be created for an action', function () {
    assertRenders(
        '<a href="http://localhost">Home</a>',
        Link::toAction(DummyController::class.'@home', 'Home')
    );
});

it('can be created for an action using tuple notation', function () {
    assertRenders(
        '<a href="http://localhost">Home</a>',
        Link::toAction([DummyController::class, 'home'], 'Home')
    );
});

it('can be created for an action with a parameter', function () {
    assertRenders(
        '<a href="http://localhost/post/1">Post #1</a>',
        Link::toAction(DummyController::class.'@post', 'Post #1', 1)
    );
});

it('can be created for an action with an array of parameters', function () {
    assertRenders(
        '<a href="http://localhost/post/1">Post #1</a>',
        Link::toAction(DummyController::class.'@post', 'Post #1', ['id' => 1])
    );
});

it('can be created for a url with javascript operator void', function () {
    assertRenders(
        '<a href="javascript:void(0);">Home</a>',
        Link::toUrl('javascript:void(0);', 'Home')
    );

    assertRenders(
        '<a href="javascript:void(0);">Home</a>',
        Link::to('javascript:void(0);', 'Home')
    );

    assertRenders(
        '<a href="javascript:;">Home</a>',
        Link::toUrl('javascript:;', 'Home')
    );

    assertRenders(
        '<a href="javascript:;">Home</a>',
        Link::to('javascript:;', 'Home')
    );

    assertRenders(
        '<a href="home">Home</a>',
        Link::to('home', 'Home')
    );

    assertRenders(
        '<a href="other/javascript">Home</a>',
        Link::to('other/javascript', 'Home')
    );
});
