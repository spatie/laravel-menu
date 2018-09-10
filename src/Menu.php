<?php

namespace Spatie\Menu\Laravel;

use Spatie\Menu\Item;
use Spatie\Menu\Menu as BaseMenu;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Support\Htmlable;

class Menu extends BaseMenu implements Htmlable
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
    public function setActiveFromRequest(string $requestRoot = '/')
    {
        return $this->setActive(app('request')->url(), $requestRoot);
    }

    /**
     * @param string $path
     * @param string $text
     * @param mixed $parameters
     * @param bool|null $secure
     *
     * @return $this
     */
    public function url(string $path, string $text, $parameters = [], $secure = null)
    {
        return $this->add(Link::toUrl($path, $text, $parameters, $secure));
    }

    /**
     * @param string|array $action
     * @param string $text
     * @param mixed $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function action($action, string $text, $parameters = [], bool $absolute = true)
    {
        return $this->add(Link::toAction($action, $text, $parameters, $absolute));
    }

    /**
     * @param string $name
     * @param string $text
     * @param mixed $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function route(string $name, string $text, $parameters = [], bool $absolute = true)
    {
        return $this->add(Link::toRoute($name, $text, $parameters, $absolute));
    }

    /**
     * @param string $name
     * @param array $data
     *
     * @return $this
     */
    public function view(string $name, array $data = [])
    {
        return $this->add(View::create($name, $data));
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
        return $this->addIf($condition, Link::toUrl($path, $text, $parameters, $secure));
    }

    /**
     * @param bool $condition
     * @param string|array $action
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function actionIf($condition, $action, string $text, array $parameters = [], bool $absolute = true)
    {
        return $this->addIf($condition, Link::toAction($action, $text, $parameters, $absolute));
    }

    /**
     * @param bool $condition
     * @param string $name
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function routeIf($condition, string $name, string $text, array $parameters = [], bool $absolute = true)
    {
        return $this->addIf($condition, Link::toRoute($name, $text, $parameters, $absolute));
    }

    /**
     * @param $condition
     * @param string $name
     * @param array $data
     *
     * @return $this
     */
    public function viewIf($condition, string $name, array $data = null)
    {
        return $this->addIf($condition, View::create($name, $data));
    }

    /**
     * @param string|array $authorization
     * @param \Spatie\Menu\Item $item
     *
     * @return $this
     */
    public function addIfCan($authorization, Item $item)
    {
        $ablityArguments = is_array($authorization) ? $authorization : [$authorization];
        $ability = array_shift($ablityArguments);

        return $this->addIf(app(Gate::class)->allows($ability, $ablityArguments), $item);
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
     * @param callable|\Spatie\Menu\Menu|\Spatie\Menu\Item $header
     * @param callable|\Spatie\Menu\Menu|null $menu
     *
     * @return $this
     */
    public function submenuIfCan($authorization, $header, $menu = null)
    {
        list($authorization, $header, $menu) = $this->parseSubmenuIfCanArgs(...func_get_args());

        $menu = $this->createSubmenuMenu($menu);
        $header = $this->createSubmenuHeader($header);

        return $this->addIfCan($authorization, $menu->prependIf($header, $header));
    }

    protected function parseSubmenuIfCanArgs($authorization, ...$args): array
    {
        return array_merge([$authorization], $this->parseSubmenuArgs($args));
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
        return $this->addIfCan($authorization, Link::toUrl($path, $text, $parameters, $secure));
    }

    /**
     * @param string|array $authorization
     * @param string|array $action
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function actionIfCan($authorization, $action, string $text, array $parameters = [], bool $absolute = true)
    {
        return $this->addIfCan($authorization, Link::toAction($action, $text, $parameters, $absolute));
    }

    /**
     * @param string|array $authorization
     * @param string $name
     * @param string $text
     * @param array $parameters
     * @param bool $absolute
     *
     * @return $this
     */
    public function routeIfCan($authorization, string $name, string $text, array $parameters = [], bool $absolute = true)
    {
        return $this->addIfCan($authorization, Link::toRoute($name, $text, $parameters, $absolute));
    }

    /**
     * @param $authorization
     * @param string $name
     * @param array $data
     *
     * @return $this
     * @internal param $condition
     */
    public function viewIfCan($authorization, string $name, array $data = null)
    {
        return $this->addIfCan($authorization, View::create($name, $data));
    }

    /**
     * @return string
     */
    public function toHtml() : string
    {
        return $this->render();
    }
}
