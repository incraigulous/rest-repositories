<?php

namespace Incraigulous\RestRepositories;


use Illuminate\Contracts\Support\Arrayable;

class Collection extends \Illuminate\Support\Collection
{
    use Collects;

    /**
     * Create a new collection.
     *
     * @param  mixed  $items
     * @return void
     */
    public function __construct($items = [], $dataKey = '')
    {
        $items = $this->toObject($items, $dataKey);
        parent::__construct($items);
    }

    public function toArray() {
        return array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : $value;
        }, $this->all());
    }
}