<?php

namespace Spatie\Menu\Laravel\Test;

use Illuminate\Auth\GenericUser;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class AddWithPermissionsTest extends TestCase
{
    /** @var \Illuminate\Auth\GenericUser */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        auth()->login(new GenericUser(['id' => 1]));
    }

    /** @test */
    function it_adds_an_item_if_the_user_has_a_certain_ability()
    {
        $this->assertRenders(
            '<ul><li><a href="/">Home</a></li></ul>',
            Menu::new()->addIfCan('computerSaysYes', Link::to('/', 'Home'))
        );
    }

    /** @test */
    function it_doesnt_add_an_item_if_the_user_doesnt_have_a_certain_ability()
    {
        $this->assertRenders(
            '<ul></ul>',
            Menu::new()->addIfCan('computerSaysNo', Link::to('/', 'Home'))
        );
    }
}
