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
     * Find a result by key.
     * @param $id
     * @return mixed
     */
    public static function find($id)
    {
        return static::formatResponse(static::sdk()->get(static::$resource . '/' . $id));
    }
}