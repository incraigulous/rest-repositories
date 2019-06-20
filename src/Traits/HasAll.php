<?php

namespace Incraigulous\RestRepositories\Traits;


trait HasAll
{
    abstract static function formatResponse($response);
    abstract static function sdk();

    /**
     * @param array $params
     *
     * @return mixed
     */
    public static function all($params = [])
    {
        try {
            return static::allOrFail($params);
        } catch (\Exception $ex) {
            return null;
        }
    }

    /**
     * @param $params
     *
     * @return mixed
     */
    public static function allOrFail($params = [])
    {
        return static::formatResponse(
            static::sdk()->get(
                static::$resource,
                static::mergeWithDefaultParams($params)
            )
        );
    }
}
