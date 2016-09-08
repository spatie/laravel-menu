<?php

namespace Spatie\Menu\Laravel;

use Illuminate\Support\Traits\Macroable;
use Spatie\Menu\Activatable;
use Spatie\Menu\HasParentAttributes;
use Spatie\Menu\Item;
use Spatie\Menu\Traits\Activatable as ActivatableTrait;
use Spatie\Menu\Traits\ParentAttributes;

class View implements Item, Activatable, HasParentAttributes
{
    use ActivatableTrait, Macroable, ParentAttributes;

    /** @var string */
    protected $name;

    /** @var array */
    protected $data;

    public function __construct(string $name, array $data = [])
    {
        $this->name = $name;
        $this->data = $data;

        $this->initializeParentAttributes();
    }

    public static function create(string $name, array $data = [])
    {
        return new static($name, $data);
    }

    public function render(): string
    {
        return view($this->name)
            ->with($this->data + ['active' => $this->isActive()])
            ->render();
    }
}
