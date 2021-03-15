<?php

namespace Spatie\Menu\Laravel\Test;

use Spatie\Menu\Laravel\Link;

class LinkTest extends TestCase
{
    /** @test */
    public function it_can_be_created_for_a_url()
    {
        $this->assertRenders(
            '<a href="http://localhost">Home</a>',
            Link::toUrl('/', 'Home')
        );
    }

    /** @test */
    public function it_can_be_created_for_a_url_with_parameters()
    {
        $this->assertRenders(
            '<a href="http://localhost/post/1">Post #1</a>',
            Link::toUrl('post', 'Post #1', ['id' => 1])
        );
    }

    /** @test */
    public function it_can_be_created_for_a_route()
    {
        $this->assertRenders(
            '<a href="http://localhost">Home</a>',
            Link::toRoute('home', 'Home')
        );
    }

    /** @test */
    public function it_can_be_created_for_a_route_with_parameters()
    {
        $this->assertRenders(
            '<a href="http://localhost/post/1">Post #1</a>',
            Link::toRoute('post', 'Post #1', ['id' => 1])
        );
    }

    /** @test */
    public function it_can_be_created_for_an_action()
    {
        $this->assertRenders(
            '<a href="http://localhost">Home</a>',
            Link::toAction(DummyController::class.'@home', 'Home')
        );
    }

    /** @test */
    public function it_can_be_created_for_an_action_using_tuple_notation()
    {
        $this->assertRenders(
            '<a href="http://localhost">Home</a>',
            Link::toAction([DummyController::class, 'home'], 'Home')
        );
    }

    /** @test */
    public function it_can_be_created_for_an_action_with_a_parameter()
    {
        $this->assertRenders(
            '<a href="http://localhost/post/1">Post #1</a>',
            Link::toAction(DummyController::class.'@post', 'Post #1', 1)
        );
    }

    /** @test */
    public function it_can_be_created_for_an_action_with_an_array_of_parameters()
    {
        $this->assertRenders(
            '<a href="http://localhost/post/1">Post #1</a>',
            Link::toAction(DummyController::class.'@post', 'Post #1', ['id' => 1])
        );
    }

    /** @test */
    public function it_can_be_created_for_a_url_with_javascript_operator_void()
    {
        $this->assertRenders(
            '<a href="javascript:void(0);">Home</a>',
            Link::toUrl('javascript:void(0);', 'Home')
        );

        $this->assertRenders(
            '<a href="javascript:void(0);">Home</a>',
            Link::to('javascript:void(0);', 'Home')
        );

        $this->assertRenders(
            '<a href="javascript:;">Home</a>',
            Link::toUrl('javascript:;', 'Home')
        );

        $this->assertRenders(
            '<a href="javascript:;">Home</a>',
            Link::to('javascript:;', 'Home')
        );

        $this->assertRenders(
            '<a href="home">Home</a>',
            Link::to('home', 'Home')
        );

        $this->assertRenders(
            '<a href="other/javascript">Home</a>',
            Link::to('other/javascript', 'Home')
        );
    }
}
