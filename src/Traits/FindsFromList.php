<?php
/**
 * FindsFromList.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories\Traits;


trait FindsFromList
{
    abstract static function formatResponse($response);
    abstract public static function all();

    /**
     * Find a result by key.
     * @param $id
     * @return mixed
     */
    public static function find($id, $by = 'id')
    {
        return static::all()->firstWhere($by, $id);
    }
}