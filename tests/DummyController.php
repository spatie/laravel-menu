<?php

namespace Spatie\Menu\Laravel\Test;

use Illuminate\Routing\Controller;

class DummyController extends Controller
{
    public function home()
    {
        return response('Home');
    }

    public function post()
    {
        return response('Post');
    }
}
