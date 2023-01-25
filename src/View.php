<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Activatable;
use Spatie\Menu\HasParentAttributes;
use Spatie\Menu\Html\Attributes;
use Spatie\Menu\Item;
use Spatie\Menu\Traits\Activatable as ActivatableTrait;
use Spatie\Menu\Traits\HasParentAttributes as HasParentAttributesTrait;

class View implements Item, Activatable, HasParentAttributes
{
    use ActivatableTrait;
    use Macroable;
    use HasParentAttributesTrait;

    protected string | null $url = null;

    protected bool $active = false;

    protected Attributes $parentAttributes;

    public function __construct(
        protected string $name,
        protected array $data = [],
    ) {
        $this->parentAttributes = new Attributes();
    }

    public static function create(string $name, array $data = []): static
    {
        $view = new static($name, $data);

        if (array_key_exists('url', $data)) {
            $view->setUrl($data['url']);
        }

        return $view;
    }

    public function render(): string
    {
        return view($this->name)
            ->with($this->data + ['active' => $this->isActive()])
            ->render();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
