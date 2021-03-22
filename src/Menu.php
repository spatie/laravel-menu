<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Item;
use Spatie\Menu\Menu as BaseMenu;

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
    public function setActiveFromRequest(string $requestRoot = '/'): self
    {
        return $this->setActive(app('request')->url(), $requestRoot);
    }

    public function url(string $path, string $text, mixed $parameters = [], bool | null $secure = null): self
    {
        return $this->add(Link::toUrl($path, $text, $parameters, $secure));
    }

    public function action(string | array $action, string $text, mixed $parameters = [], bool $absolute = true): self
    {
        return $this->add(Link::toAction($action, $text, $parameters, $absolute));
    }

    public function route(string $name, string $text, mixed $parameters = [], bool $absolute = true): self
    {
        return $this->add(Link::toRoute($name, $text, $parameters, $absolute));
    }

    public function view(string $name, array $data = []): self
    {
        return $this->add(View::create($name, $data));
    }

    public function urlIf(bool $condition, string $path, string $text, array $parameters = [], bool | null $secure = null): self
    {
        return $this->addIf($condition, Link::toUrl($path, $text, $parameters, $secure));
    }

    public function actionIf(bool $condition, string | array $action, string $text, array $parameters = [], bool $absolute = true): self
    {
        return $this->addIf($condition, Link::toAction($action, $text, $parameters, $absolute));
    }

    public function routeIf(bool $condition, string $name, string $text, array $parameters = [], bool $absolute = true): self
    {
        return $this->addIf($condition, Link::toRoute($name, $text, $parameters, $absolute));
    }

    public function viewIf($condition, string $name, array | null $data = null): self
    {
        return $this->addIf($condition, View::create($name, $data));
    }

    public function addIfCan(string | array $authorization, Item $item): self
    {
        $abilityArguments = is_array($authorization) ? $authorization : [$authorization];
        $ability = array_shift($abilityArguments);

        return $this->addIf(app(Gate::class)->allows($ability, $abilityArguments), $item);
    }

    public function linkIfCan(string | array $authorization, string $url, string $text): self
    {
        return $this->addIfCan($authorization, Link::to($url, $text));
    }

    public function htmlIfCan(string | array $authorization, string $html): Menu
    {
        return $this->addIfCan($authorization, Html::raw($html));
    }

    public function submenuIfCan(string | array $authorization, callable | BaseMenu | Item $header, callable | BaseMenu | null $menu = null): self
    {
        [$authorization, $header, $menu] = $this->parseSubmenuIfCanArgs(...func_get_args());

        $menu = $this->createSubmenuMenu($menu);
        $header = $this->createSubmenuHeader($header);

        return $this->addIfCan($authorization, $menu->prependIf($header, $header));
    }

    protected function parseSubmenuIfCanArgs($authorization, ...$args): array
    {
        return array_merge([$authorization], $this->parseSubmenuArgs($args));
    }

    public function urlIfCan(string | array $authorization, string $path, string $text, array $parameters = [], bool | null $secure = null): self
    {
        return $this->addIfCan($authorization, Link::toUrl($path, $text, $parameters, $secure));
    }

    public function actionIfCan(string | array $authorization, string | array $action, string $text, array $parameters = [], bool $absolute = true): self
    {
        return $this->addIfCan($authorization, Link::toAction($action, $text, $parameters, $absolute));
    }

    public function routeIfCan(string | array $authorization, string $name, string $text, array $parameters = [], bool $absolute = true): self
    {
        return $this->addIfCan($authorization, Link::toRoute($name, $text, $parameters, $absolute));
    }

    /**
     * @internal param $condition
     */
    public function viewIfCan(string | array $authorization, string $name, array | null $data = null): self
    {
        return $this->addIfCan($authorization, View::create($name, $data));
    }

    public function toHtml(): string
    {
        return $this->render();
    }
}
