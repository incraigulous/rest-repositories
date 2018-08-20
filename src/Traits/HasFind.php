<?php
/**
 * HasFind.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories\Traits;


trait HasFind
{
    abstract static function formatResponse($response);
    abstract static function sdk();

    /**
     * @param       $id
     * @param array $params
     *
     * @return mixed
     */
    public static function find($id, $params = [])
    {
        try {
            return self::findOrFail($id, $params);
        } catch (\Exception $exception) {
            return null;
        }
    }

    /**
     * @param       $id
     * @param array $params
     *
     * @return mixed
     */
    public static function findOrFail($id, $params = [])
    {
        return static::formatResponse(
            static::sdk()->get(
                static::$resource . '/' . $id,
                static::mergeWithDefaultParams($params)
            )
        );
    }
}
