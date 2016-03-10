<?php

namespace Spatie\Menu\Laravel\Items;

use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Items\Link as BaseLink;

class Link extends BaseLink
{
    use Macroable;

    public static function url(string $path, string $text, $parameters = [], $secure = null)
    {
        return static::to(url($path, $parameters, $secure), $text);
    }

    public static function action(string $action, string $text, $parameters = [], $absolute = true)
    {
        return static::to(action($action, $parameters, $absolute), $text);
    }

    public static function route(string $name, string $text, $parameters = [], $absolute = true, $route = null)
    {
        return static::to(route($name, $parameters, $absolute, $route), $text);
    }
}
