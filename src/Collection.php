<?php

namespace Incraigulous\RestRepositories;


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
}