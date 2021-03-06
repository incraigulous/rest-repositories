<?php
/**
 * HasUpdate.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories\Traits;


trait HasUpdate
{
    abstract static protected function formatResponse($response);
    abstract static function sdk();

    /**
     * Update the resource
     * @param  array  $payload [description]
     * @return array
     */
    public static function update($id, $payload = [])
    {
        return static::formatResponse(
            static::sdk()->put(
                static::$resource . '/' . $id,
                $payload
            )
        );
    }
}
