<?php
/**
 * Created by PhpStorm.
 * User: craigw
 * Date: 5/31/17
 * Time: 11:41 AM
 */

namespace Incraigulous\RestRepositories;


trait Collects
{
    protected function collect($data, $dataKey)
    {
        $result = [];
        $data = $this->unKey($data, $dataKey);
        foreach($data as $key => $record) {
            $record = $this->unKey($record, $dataKey);
            if (!is_array($record)) {
                $result[$key] = $record;
            } elseif ($this->isAssoc($record)) {
                $result[$key] = new Object($record, $dataKey);
            } else {
                $result[$key] = new Collection($record, $dataKey);
            }
        }
        return $result;
    }

    protected function isAssoc($arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    public function unKey($data, $key) {
        if ($key && !empty($data[$key])) {
            $data = $data[$key];
        }
        return $data;
    }
}