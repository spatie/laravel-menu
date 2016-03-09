<?php

namespace Spatie\Menu\Laravel;

use Spatie\Menu\Items\Link;
use Spatie\Menu\Menu as BaseMenu;

class Menu extends BaseMenu
{
    /**
     * @param string $requestRoot
     *
     * @return static
     */
    public function setActiveFromRequest(string $requestRoot = '')
    {
        $requestHost = app('request')->getHost();
        $requestPath = app('request')->path();

        $this->each(function (BaseMenu $menu) {
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
