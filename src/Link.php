<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Html\Attributes;
use Spatie\Menu\Link as BaseLink;

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

    public static function to(string $url, string $text)
    {
        if (strpos($url, 'javascript:void(0);') || strpos($url, 'javascript:;')) {
            $url = '/' . $url;
        }

        return new static($url, $text);
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

    /**
     * @return string
     */
    public function render(): string
    {
        if (strpos($this->url, 'javascript:void(0);') || strpos($this->url, 'javascript:;')) {
            $this->url = substr($this->url, 1);
        }

        if (filter_var($this->url, FILTER_VALIDATE_URL) && (strpos($this->url, 'javascript:void(0);') || strpos($this->url, 'javascript:;'))) {
            $this->url = parse_url($this->url, PHP_URL_PATH);
            $this->url = substr($this->url, 1);
        }

        $attributes = new Attributes(['href' => $this->url]);
        $attributes->mergeWith($this->htmlAttributes);

        return $this->prepend . "<a {$attributes}>{$this->text}</a>" . $this->append;
    }
}
