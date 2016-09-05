<?php

namespace Spatie\Menu\Laravel;

use Spatie\Menu\Activatable;
use Spatie\Menu\Item;
use Spatie\Menu\Traits\Activatable as ActivatableTrait;

class View implements Item, Activatable
{
    use ActivatableTrait;

    /** @var string */
    protected $name;

    /** @var array */
    protected $data;

    public function __construct(string $name, array $data = [])
    {
        $this->name = $name;
        $this->data = $data;
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
