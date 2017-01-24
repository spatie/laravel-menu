<?php

namespace Spatie\Menu\Laravel\Test;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;
use Illuminate\Auth\GenericUser;

class AddWithPermissionsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        auth()->login(new GenericUser(['id' => 1]));
    }

    /** @test */
    public function it_adds_an_item_if_the_user_has_a_certain_ability()
    {
        $this->assertRenders(
            '<ul><li><a href="/">Home</a></li></ul>',
            Menu::new()->addIfCan('computerSaysYes', Link::to('/', 'Home'))
        );
    }

    /** @test */
    public function it_doesnt_add_an_item_if_the_user_doesnt_have_a_certain_ability()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->addIfCan('computerSaysNo', Link::to('/', 'Home'))
        );
    }

    /** @test */
    public function it_parses_argument_if_an_ability_is_provided_as_an_array()
    {
        $this->assertRenders(
            '<ul><li><a href="/">Home</a></li></ul>',
            Menu::new()->addIfCan(['computerSaysMaybe', true], Link::to('/', 'Home'))
        );

        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->addIfCan(['computerSaysMaybe', false], Link::to('/', 'Home'))
        );
    }

    /** @test */
    public function it_adds_a_link_if_the_user_has_a_certain_ability()
    {
        $this->assertRenders(
            '<ul><li><a href="/">Home</a></li></ul>',
            Menu::new()->linkIfCan('computerSaysYes', '/', 'Home')
        );
    }

    /** @test */
    public function it_doesnt_add_a_link_if_the_user_doesnt_have_a_certain_ability()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->linkIfCan('computerSaysNo', '/', 'Home')
        );
    }

    /** @test */
    public function it_adds_html_if_the_user_has_a_certain_ability()
    {
        $this->assertRenders(
            '<ul><li><a href="/">Home</a></li></ul>',
            Menu::new()->htmlIfCan('computerSaysYes', '<a href="/">Home</a>')
        );
    }

    /** @test */
    public function it_doesnt_add_html_if_the_user_doesnt_have_a_certain_ability()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->htmlIfCan('computerSaysNo', '<a href="/">Home</a>')
        );
    }

    /** @test */
    public function it_adds_a_url_if_the_user_has_a_certain_ability()
    {
        $this->assertRenders(
            '<ul><li><a href="http://localhost">Home</a></li></ul>',
            Menu::new()->urlIfCan('computerSaysYes', '/', 'Home')
        );
    }

    /** @test */
    public function it_doesnt_add_a_url_if_the_user_doesnt_have_a_certain_ability()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->urlIfCan('computerSaysNo', '/', 'Home')
        );
    }

    /** @test */
    public function it_adds_an_action_if_the_user_has_a_certain_ability()
    {
        $this->assertRenders(
            '<ul><li><a href="http://localhost">Home</a></li></ul>',
            Menu::new()->actionIfCan('computerSaysYes', DummyController::class.'@home', 'Home')
        );
    }

    /** @test */
    public function it_doesnt_add_an_action_if_the_user_doesnt_have_a_certain_ability()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->actionIfCan('computerSaysNo', DummyController::class.'@home', 'Home')
        );
    }

    /** @test */
    public function it_adds_a_route_if_the_user_has_a_certain_ability()
    {
        $this->assertRenders(
            '<ul><li><a href="http://localhost">Home</a></li></ul>',
            Menu::new()->routeIfCan('computerSaysYes', 'home', 'Home')
        );
    }

    /** @test */
    public function it_doesnt_add_a_route_if_the_user_doesnt_have_a_certain_ability()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->routeIfCan('computerSaysNo', 'home', 'Home')
        );
    }

    /** @test */
    public function it_adds_a_submenu_if_the_user_has_a_certain_ability()
    {
        $this->assertRenders(
            '<ul><li><a href="home">Home</a><ul><li><a href="sub">Sub</a></li></ul></li></ul>',
            Menu::new()->submenuIfCan('computerSaysYes', Link::to('home', 'Home'), Menu::new()->link('sub', 'Sub'))
        );
    }

    /** @test */
    public function it_doesnt_add_a_submenu_if_the_user_doesnt_have_a_certain_ability()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->submenuIfCan('computerSaysNo', Link::to('home', 'Home'), Menu::new()->link('sub', 'Sub'))
        );
    }
}
