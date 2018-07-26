<?php

namespace Incraigulous\RestRepositories;

use SchulzeFelix\DataTransferObject\DataTransferObject;

class Item extends DataTransferObject
{
    use Collects;

    public function __construct(array $attributes = [], $dataKey = '')
    {
        $attributes = $this->collect($attributes, $dataKey);
        $this->fill($attributes);
    }
    
    /**
     * Get the attributes that should be converted to dates.
     *
     * @return array
     */
    public function getDates()
    {
        return $this->dates;
    }
}
