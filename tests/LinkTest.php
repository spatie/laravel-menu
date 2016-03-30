<?php

namespace Spatie\Menu\Laravel\Test;

use Spatie\Menu\Laravel\Link;

class LinkTest extends TestCase
{
    /** @test */
    function it_can_be_created_for_a_url()
    {
        $this->assertRenders(
            '<a href="http://localhost">Home</a>',
            Link::url('/', 'Home')
        );
    }

    /** @test */
    function it_can_be_created_for_a_url_with_parameters()
    {
        $this->assertRenders(
            '<a href="http://localhost/post/1">Post #1</a>',
            Link::url('post', 'Post #1', ['id' => 1])
        );
    }

    /** @test */
    function it_can_be_created_for_a_route()
    {
        $this->assertRenders(
            '<a href="http://localhost">Home</a>',
            Link::route('home', 'Home')
        );
    }

    /** @test */
    function it_can_be_created_for_a_route_with_parameters()
    {
        $this->assertRenders(
            '<a href="http://localhost/post/1">Post #1</a>',
            Link::route('post', 'Post #1', ['id' => 1])
        );
    }

    /** @test */
    function it_can_be_created_for_an_action()
    {
        $this->assertRenders(
            '<a href="http://localhost">Home</a>',
            Link::action(DummyController::class . '@home', 'Home')
        );
    }

    /** @test */
    function it_can_be_created_for_an_action_with_parameters()
    {
        $this->assertRenders(
            '<a href="http://localhost/post/1">Post #1</a>',
            Link::action(DummyController::class . '@post', 'Post #1', ['id' => 1])
        );
    }
}
