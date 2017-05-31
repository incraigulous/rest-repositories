<?php

namespace Incraigulous\RestRepositories;

use SchulzeFelix\DataTransferObject\DataTransferObject;

class Object extends DataTransferObject
{
    use Collects;

    public function __construct(array $attributes = [], $dataKey = '')
    {
        $attributes = $this->collect($attributes, $dataKey);
        $this->fill($attributes);
    }
}