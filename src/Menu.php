<?php

namespace App\Services\Navigation;

use Spatie\Menu\Items\Link;
use Spatie\Menu\Menu as BaseMenu;

class Menu extends BaseMenu
{
    /**
     * @var string
     */
    protected static $requestRoot = '';

    /**
     * @param string $text
     * @param string $action
     * @param array $params
     *
     * @return static
     */
    public function addAction(string $text, string $action, array $params = [])
    {
        return $this->addLink($text, action($action, $params));
    }

    /**
     * @param string $text
     * @param string $name
     * @param array $params
     *
     * @return static
     */
    public function addRoute(string $text, string $name, array $params = [])
    {
        return $this->addLink($text, route($name, $params));
    }

    /**
     * @return static
     */
    public function setActiveFromRequest()
    {
        $requestHost = request()->getHost();
        $requestPath = request()->path();

        return $this->setActive(function (Link $link) use ($requestHost, $requestPath) {

            $parsed = parse_url($link->url());

            $host = trim($parsed['host'] ?? '', '/');
            $path = trim($parsed['path'] ?? '', '/');

            // If the menu item is on a different host it can't be active
            if ($host !== '' && $host !== $requestHost) {
                return false;
            }

            // The root (home) page is a special case
            if ($path === static::$requestRoot) {
                return $path === $requestPath;
            }

            return strpos($requestPath, $path) === 0;
        });
    }

    /**
     * @param string $requestRoot
     */
    public static function setRequestRoot(string $requestRoot)
    {
        static::$requestRoot = $requestRoot;
    }
}
