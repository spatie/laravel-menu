<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Link as BaseLink;

class Link extends BaseLink
{
    use Macroable;

    /**
     * @param string $path
     * @param string $text
     * @param array $parameters
     * @param bool|null $secure
     *
     * @return $this
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
     * @return $this
     */
    public static function action(string $action, string $text, $parameters = [], bool $absolute = true)
    {
        return static::to(action($action, $parameters, $absolute), $text);
    }

    /**
     * @param string $name
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     * @param \Illuminate\Routing\Route|null $route
     *
     * @return $this
     */
    public static function route(string $name, string $text, $parameters = [], $absolute = true, $route = null)
    {
        return static::to(route($name, $parameters, $absolute, $route), $text);
    }
}
