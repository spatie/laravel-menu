<?php

namespace Spatie\Menu\Laravel\Test;

use Illuminate\Contracts\Auth\Access\Gate;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Spatie\Menu\Item;

class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app['router']->get('/', ['as' => 'home', 'uses' => DummyController::class.'@home']);
        $this->app['router']->get('/post/{id}', ['as' => 'post', 'uses' => DummyController::class.'@post']);

        $this->app->make(Gate::class)->define('computerSaysYes', function () {
            return true;
        });

        $this->app->make(Gate::class)->define('computerSaysNo', function () {
            return false;
        });

        $this->app->make(Gate::class)->define('computerSaysMaybe', function ($user, $argument) {
            return $argument;
        });
    }

    protected function assertRenders(string $expected, Item $item, string $message = '')
    {
        $this->assertEquals($this->sanitizeHtmlWhitespace($expected), $item->render(), $message);
    }

    protected function sanitizeHtmlWhitespace(string $subject) : string
    {
        $find = ['/>\s+</', '/(^\s+)|(\s+$)/'];
        $replace = ['><', ''];

        return preg_replace($find, $replace, $subject);
    }
}
