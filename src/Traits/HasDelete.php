<?php
/**
 * HasDelete.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories\Traits;


trait HasDelete
{
    abstract static function formatResponse($response);
    abstract static function sdk();

    /**
     * Delete a resource
     * @param $payload
     * @return mixed
     */
    public static function delete($payload)
    {
        return static::formatResponse(
            static::sdk()->delete(
                static::$resource,
                $payload
            )
        );
    }
}
