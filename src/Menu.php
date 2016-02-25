<?php

namespace Spatie\Menu\Laravel;

use Spatie\Menu\Items\Link;
use Spatie\Menu\Menu as BaseMenu;

class Menu extends BaseMenu
{
    /**
     * @var string
     */
    protected $requestRoot;

    /**
     * @param string $action
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     *
     * @return static
     */
    public function addAction(string $action, string $text, array $parameters = [], $absolute = true)
    {
        return $this->addItem(Link::create(action($action, $parameters, $absolute), $text));
    }

    /**
     * @param string $text
     * @param string $name
     * @param array $parameters
     * @param bool $absolute
     *
     * @return static
     */
    public function addRoute(string $name, string $text, array $parameters = [], $absolute = true)
    {
        return $this->addItem(Link::create(route($name, $parameters, $absolute), $text));
    }

    /**
     * @param string $path
     * @param string $text
     * @param array $parameters
     * @param bool $secure
     *
     * @return static
     */
    public function addUrl(string $path, string $text, $parameters = [], $secure = true)
    {
        return $this->addItem(Link::create(url($path, $parameters, $secure), $text));
    }

    /**
     * @return static
     */
    public function setActiveFromRequest()
    {
        $requestHost = request()->getHost();
        $requestPath = request()->path();

        $this->manipulate(function (Menu $menu) {
            $menu->setActiveFromRequest();
        });

        $this->setActive(function (Link $link) use ($requestHost, $requestPath) {

            $parsed = parse_url($link->url());

            $host = trim($parsed['host'] ?? '', '/');
            $path = trim($parsed['path'] ?? '', '/');

            // If the menu item is on a different host it can't be active
            if ($host !== '' && $host !== $requestHost) {
                return false;
            }

            // The root (home) page is a special case
            if ($path === $this->requestRoot) {
                return $path === $requestPath;
            }

            return strpos($requestPath, $path) === 0;
        });

        return $this;
    }

    /**
     * @param string $requestRoot
     *
     * @return static
     */
    public function setRequestRoot(string $requestRoot)
    {
        $this->requestRoot = $requestRoot;

        return $this;
    }
}
