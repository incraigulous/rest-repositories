<?php

namespace Incraigulous\RestRepositories;


class Collection extends \Illuminate\Support\Collection
{
    /**
     * Create a new collection.
     *
     * @param  mixed  $items
     * @return void
     */
    public function __construct($items = [], $dataKey = 'data')
    {
        $items = $this->collect($items, $dataKey);
        parent::__construct($items);
    }

    protected function collect($data, $dataKey)
    {
        $result = [];
        foreach(!empty($data[$dataKey]) ? $data[$dataKey] : $data as $key => $record) {
            if (!is_array($record)) {
                $result[$key] = $record;
                continue;
            }
            $result[$key] = ($this->is_multi($record)) ? new Collection($record) : new Object($record);
        }
        return $result;
    }

    protected function is_multi($a) {
        $rv = array_filter($a,'is_array');
        if(count($rv)>0) return true;
        return false;
    }
}