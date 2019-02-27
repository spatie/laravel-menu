<?php

namespace Spatie\Menu\Laravel\Test;

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\View;

class ViewTest extends TestCase
{
    /** @test */
    public function it_can_render_a_simple_view()
    {
        $this->assertRenders('Hello, menu!', View::create('simple'));
    }

    /** @test */
    public function it_receives_an_active_variable()
    {
        $this->assertRenders('I\'m active', View::create('withActive')->setActive());
        $this->assertRenders('I\'m inactive', View::create('withActive')->setInactive());
    }

    /** @test */
    public function it_can_receive_extra_data()
    {
        $this->assertRenders('Hello, Sebastian!', View::create('withData', ['name' => 'Sebastian']));
    }

    /** @test */
    public function it_can_receive_a_url_through_extra_data()
    {
        $menu = Menu::new()
            ->view('simple', ['url' => '/'])
            ->view('simple', ['url' => '/about']);

        $this->assertRenders("
            <ul>
                <li>Hello, menu!\n</li>
                <li>Hello, menu!\n</li>
            </ul>
        ", $menu);
    }
}
