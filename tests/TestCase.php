<?php

namespace Spatie\Menu\Laravel\Test;

use Illuminate\Contracts\Auth\Access\Gate;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
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

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('view.paths', [__DIR__.'/resources/views']);
    }
}
