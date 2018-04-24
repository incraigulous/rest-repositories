<?php
/**
 * HasCreate.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories\Traits;


trait HasCreate
{
    abstract static function formatResponse($response);
    abstract static function sdk();

    /**
     * Create a resource
     * @param $payload
     * @return mixed
     */
    public static function create($payload)
    {
        return static::formatResponse(static::sdk()->post(static::$resource, $payload));
    }
}