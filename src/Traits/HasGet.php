<?php
/**
 * HasGet.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories\Traits;


trait HasGet
{
    abstract static function formatResponse($response);
    abstract static function sdk();

    /**
     * Get the resource.
     * @param  array  $params [description]
     * @return array
     */
    public static function get($params = [])
    {
        try {
            return static::getOrFail($params);
        } catch (\Exception $ex) {
            return null;
        }
    }

    /**
     * Get the resource.
     * @param  array  $params [description]
     * @return array
     */
    public static function getOrFail($params = [])
    {
        return static::formatResponse(
            static::sdk()->get(
                static::$resource,
                static::mergeWithDefaultParams($params)
            )
        );
    }
}
