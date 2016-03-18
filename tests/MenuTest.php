<?php

namespace Spatie\Menu\Laravel\Test;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class MenuTest extends TestCase
{
    /** @test */
    function it_can_set_items_active_based_on_the_current_request()
    {
        $this->call('get', '/post/1');

        $menu = Menu::new()
            ->add(Link::route('home', 'Home'))
            ->add(Link::route('post', 'Post #1', [1]))
            ->setActiveFromRequest();

        $this->assertRenders(
            '<ul>
                <li><a href="http://localhost">Home</a></li>
                <li class="active"><a href="http://localhost/post/1">Post #1</a></li>
            </ul>',
            $menu
        );
    }
}
