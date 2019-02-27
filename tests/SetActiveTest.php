<?php

namespace Spatie\Menu\Laravel\Test;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class SetActiveTest extends TestCase
{
    /** @test */
    public function it_can_set_items_active_based_on_the_current_request()
    {
        $this->call('get', '/post/1');

        $menu = Menu::new()
            ->add(Link::toRoute('home', 'Home'))
            ->add(Link::toRoute('post', 'Post #1', [1]))
            ->setActiveFromRequest();

        $this->assertRenders(
            '<ul>
                <li><a href="http://localhost">Home</a></li>
                <li class="active exact-active"><a href="http://localhost/post/1">Post #1</a></li>
            </ul>',
            $menu
        );
    }
}
