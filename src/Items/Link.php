<?php

namespace Spatie\Menu\Laravel\Items;

use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Items\Link as BaseLink;

class Link extends BaseLink
{
    use Macroable;

    /**
     * @param string $path
     * @param string $text
     * @param array $parameters
     * @param null $secure
     *
     * @return static
     */
    public static function url(string $path, string $text, $parameters = [], $secure = null)
    {
        return static::to(url($path, $parameters, $secure), $text);
    }

    /**
     * @param string $action
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     * @return static
     */
    public static function action(string $action, string $text, $parameters = [], $absolute = true)
    {
        return static::to(action($action, $parameters, $absolute), $text);
    }

    /**
     * @param string $name
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     * @param null $route
     *
     * @return static
     */
    public static function route(string $name, string $text, $parameters = [], $absolute = true, $route = null)
    {
        return static::to(route($name, $parameters, $absolute, $route), $text);
    }
}
