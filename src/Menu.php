<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Items\Link;
use Spatie\Menu\Menu as BaseMenu;

class Menu extends BaseMenu
{
    use Macroable;

    /**
     * Set all relevant children active based on the current request's URL.
     *
     * /, /about, /contact => request to /about will set the about link active.
     *
     * /en, /en/about, /en/contact => request to /en won't set /en active if the request root
     *                                is set to /en.
     *
     * @param string $requestRoot If the link's URL is an exact match with the request root, the
     *                            link won't be set active. This behavior is to avoid having home
     *                            links active on every request.
     *
     * @return static
     */
    public function setActiveFromRequest(string $requestRoot = '')
    {
        $requestHost = app('request')->getHost();
        $requestPath = app('request')->path();

        $this->each(function (Menu $menu) {
            $menu->setActiveFromRequest();
        });

        $this->setActive(function (Link $link) use ($requestHost, $requestPath, $requestRoot) {

            $parsed = parse_url($link->getUrl());

            $host = trim($parsed['host'] ?? '', '/');
            $path = trim($parsed['path'] ?? '', '/');

            // If the menu item is on a different host it can't be active
            if ($host !== '' && $host !== $requestHost) {
                return false;
            }

            // The root (home) page is a special case
            if ($path === $requestRoot) {
                return $path === $requestPath;
            }

            return strpos($requestPath, $path) === 0;
        });

        return $this;
    }
}
