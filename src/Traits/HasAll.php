<?php
/**
 * HasAll.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories\Traits;


trait HasAll
{
    abstract static function formatResponse($response);
    abstract static function sdk();

    /**
     * Return the entire resource.
     * @return \Illuminate\Support\Collection
     */
    public static function all()
    {
        return static::formatResponse(static::sdk()->get(static::$resource));
    }
}