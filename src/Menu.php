<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Traits\Macroable;
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
}
