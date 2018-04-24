<?php
namespace Incraigulous\RestRepositories;

use Incraigulous\RestRepositories\Contracts\RepositoryInterface;
use Incraigulous\RestRepositories\Contracts\SdkInterface;


/**
 * The base repository.
 */
abstract class Repository implements RepositoryInterface
{
    static protected $resource;
    static protected $dataKey;

    public abstract static function sdk();

    /**
     * Format the response.
     * @param $response
     * @return Collection|Object
     */
    protected static function formatResponse($response) {
        return static::objectify($response);
    }

    /**
     * Turn the data into nested collections or an arrayable object.
     * @param $data
     * @return Collection|Object
     */
    protected static function objectify($data)
    {
        $data = (static::$dataKey && !empty($data[static::$dataKey])) ? $data[static::$dataKey] : $data;
        return (static::isAssoc($data)) ? new Object($data, static::$dataKey) : new Collection($data, static::$dataKey);
    }

    protected static function isAssoc($arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}