<?php

namespace Spatie\Menu\Laravel;

use Spatie\Menu\Item;
use Spatie\Menu\Activatable;
use Spatie\Menu\Html\Attributes;
use Spatie\Menu\HasParentAttributes;
use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Traits\Activatable as ActivatableTrait;
use Spatie\Menu\Traits\HasParentAttributes as HasParentAttributesTrait;

class View implements Item, Activatable, HasParentAttributes
{
    use ActivatableTrait, Macroable, HasParentAttributesTrait;

    /** @var string */
    protected $name;

    /** @var array */
    protected $data;

    /** @var string|null */
    protected $url = null;

    /** @var bool */
    protected $active = false;

    /** @var Attributes */
    protected $parentAttributes;

    public function __construct(string $name, array $data = [])
    {
        $this->name = $name;
        $this->data = $data;
        $this->parentAttributes = new Attributes();
    }

    /**
     * @param string $name
     * @param array $data
     *
     * @return static
     */
    public static function create(string $name, array $data = [])
    {
        $view = new static($name, $data);

        if (array_key_exists('url', $data)) {
            $view->setUrl($data['url']);
        }

        return $view;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return view($this->name)
            ->with($this->data + ['active' => $this->isActive()])
            ->render();
    }
}
