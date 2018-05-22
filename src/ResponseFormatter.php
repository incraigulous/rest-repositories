<?php
/**
 * ResourceFactoryactory.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories;


class ResponseFormatter
{
    /**
     * Turn the data into nested collections or an arrayable object.
     * @param $data
     * @param $dataKey
     * @return Collection|Object
     */
    public static function format($data, $dataKey = null)
    {
        $data = ($dataKey && isset($data[$dataKey])) ? $data[$dataKey] : $data;

        return (static::isAssoc($data)) ? new Object($data, $dataKey) : new Collection($data, $dataKey);
    }

    protected static function isAssoc($arr)
    {
        if ([] === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}