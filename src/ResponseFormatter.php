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
     * @param $response
     * @param $dataKey
     * @return Collection|Object
     */
    public static function format($response, $dataKey = null)
    {
        $data = ($dataKey && isset($response[$dataKey])) ? $response[$dataKey] : $response;

        if (!$data) {
            return null;
        }

        return (static::isAssoc($data)) ? new Object($response, $dataKey) : new Collection($response, $dataKey);
    }

    protected static function isAssoc($arr)
    {
        if ([] === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}