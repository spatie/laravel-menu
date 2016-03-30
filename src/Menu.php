<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Traits\Macroable;
use Gate;
use Spatie\Menu\Menu as BaseMenu;

class Menu extends BaseMenu
{
    use Macroable;

    /**
     * Set all relevant children active based on the current request's URL.
     *
     * /, /about, /contact => request to /about will set the about link active.
     *
     * /en, /en/about, /en/contact => request to /en won't set /en active if the
     *                                request root is set to /en.
     *
     * @param string $requestRoot If the link's URL is an exact match with the
     *                            request root, the link won't be set active.
     *                            This behavior is to avoid having home links
     *                            active on every request.
     *
     * @return $this
     */
    public function setActiveFromRequest(string $requestRoot = '')
    {
        return $this->setActive(app('request')->url(), $requestRoot);
    }

    /**
     * @param string $path
     * @param string $text
     * @param array $parameters
     * @param bool|null $secure
     *
     * @return $this
     */
    public function url(string $path, string $text, array $parameters = [], $secure = null)
    {
        return $this->add(Link::url($path, $text, $parameters, $secure));
    }

    /**
     * @param string $action
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function action(string $action, string $text, array $parameters = [], bool $absolute = true)
    {
        return $this->add(Link::action($action, $text, $parameters, $absolute));
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
    public function route(string $name, string $text, array $parameters = [], bool $absolute = true, $route = null)
    {
        return $this->add(Link::route($name, $text, $parameters, $absolute, $route));
    }

    /**
     * @param bool $condition
     * @param string $path
     * @param string $text
     * @param array $parameters
     * @param bool|null $secure
     *
     * @return $this
     */
    public function urlIf($condition, string $path, string $text, array $parameters = [], $secure = null)
    {
        return $this->addIf($condition, Link::url($path, $text, $parameters, $secure));
    }

    /**
     * @param bool $condition
     * @param string $action
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function actionIf($condition, string $action, string $text, array $parameters = [], bool $absolute = true)
    {
        return $this->addIf($condition, Link::action($action, $text, $parameters, $absolute));
    }

    /**
     * @param bool $condition
     * @param string $name
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     * @param \Illuminate\Routing\Route|null $route
     *
     * @return $this
     */
    public function routeIf($condition, string $name, string $text, array $parameters = [], bool $absolute = true, $route = null)
    {
        return $this->addIf($condition, Link::route($name, $text, $parameters, $absolute, $route));
    }

    /**
     * @param string|array $authorization
     * @param \Spatie\Menu\Laravel\Item $item
     *
     * @return $this
     */
    public function addIfCan($authorization, Item $item)
    {
        $arguments = is_array($authorization) ? $authorization : [$authorization];
        $ability = array_shift($ablityArguments);

        return $this->addIf(Gate::allows($ability, $arguments), $item);
    }

    /**
     * @param string|array $authorization
     * @param string $url
     * @param string $text
     *
     * @return $this
     */
    public function linkIfCan($authorization, string $url, string $text)
    {
        return $this->addIfCan($authorization, Link::to($url, $text));
    }

    /**
     * @param string|array $authorization
     * @param string $html
     *
     * @return \Spatie\Menu\Laravel\Menu
     */
    public function htmlIfCan($authorization, string $html)
    {
        return $this->addIfCan($authorization, Html::raw($html));
    }

    /**
     * @param string|array $authorization
     * @param string $path
     * @param string $text
     * @param array $parameters
     * @param bool|null $secure
     *
     * @return $this
     */
    public function urlIfCan($authorization, string $path, string $text, array $parameters = [], $secure = null)
    {
        return $this->addIfCan($authorization, Link::url($path, $text, $parameters, $secure));
    }

    /**
     * @param string|array $authorization
     * @param string $action
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function actionIfCan($authorization, string $action, string $text, array $parameters = [], bool $absolute = true)
    {
        return $this->addIfCan($authorization, Link::action($action, $text, $parameters, $absolute));
    }

    /**
     * @param string|array $authorization
     * @param string $name
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     * @param \Illuminate\Routing\Route|null $route
     *
     * @return $this
     */
    public function routeIfCan($authorization, string $name, string $text, array $parameters = [], bool $absolute = true, $route = null)
    {
        return $this->addIfCan($authorization, Link::route($name, $text, $parameters, $absolute, $route));
    }
}
