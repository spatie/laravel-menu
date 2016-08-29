<?php

namespace Spatie\Menu\Laravel\Test;

use Spatie\Menu\Laravel\Menu;

class AddConditionalTest extends TestCase
{
    /** @test */
    public function it_adds_a_url_if_the_condition_is_true()
    {
        $this->assertRenders(
            '<ul><li><a href="http://localhost">Home</a></li></ul>',
            Menu::new()->urlIf(true, '/', 'Home')
        );
    }

    /** @test */
    public function it_doesnt_add_a_url_if_the_condition_isnt_true()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->urlIf(false, '/', 'Home')
        );
    }

    /** @test */
    public function it_adds_an_action_if_the_condition_is_true()
    {
        $this->assertRenders(
            '<ul><li><a href="http://localhost">Home</a></li></ul>',
            Menu::new()->actionIf(true, DummyController::class.'@home', 'Home')
        );
    }

    /** @test */
    public function it_doesnt_add_an_action_if_the_condition_isnt_true()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->actionIf(false, DummyController::class.'@home', 'Home')
        );
    }

    /** @test */
    public function it_adds_a_route_if_the_condition_is_true()
    {
        $this->assertRenders(
            '<ul><li><a href="http://localhost">Home</a></li></ul>',
            Menu::new()->routeIf(true, 'home', 'Home')
        );
    }

    /** @test */
    public function it_doesnt_add_a_route_if_the_condition_isnt_true()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->routeIf(false, 'home', 'Home')
        );
    }
}
