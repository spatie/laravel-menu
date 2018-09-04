<?php

namespace Spatie\Menu\Laravel;

use Spatie\Menu\Link as BaseLink;
use Illuminate\Support\Traits\Macroable;

class Link extends BaseLink
{
    use Macroable;

    /**
     * @param string $path
     * @param string $text
     * @param mixed $parameters
     * @param bool|null $secure
     *
     * @return static
     */
    public static function toUrl(string $path, string $text, $parameters = [], $secure = null)
    {
        return static::to(url($path, $parameters, $secure), $text);
    }

    /**
     * @param string|array $action
     * @param string $text
     * @param mixed $parameters
     * @param bool $absolute
     *
     * @return static
     */
    public static function toAction($action, string $text, $parameters = [], bool $absolute = true)
    {
        if (is_array($action)) {
            $action = implode('@', $action);
        }

        return static::to(action($action, $parameters, $absolute), $text);
    }

    /**
     * @param string $name
     * @param string $text
     * @param mixed $parameters
     * @param bool $absolute
     *
     * @return static
     */
    public static function toRoute(string $name, string $text, $parameters = [], $absolute = true)
    {
        return static::to(route($name, $parameters, $absolute), $text);
    }
}
