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
     * @return Collection|Item
     */
    protected static function formatResponse($response) {
        return ResponseFormatter::format($response, static::$dataKey);
    }

    /**
     * Override to set default  parameters for all repository GET requests.
     * @return array
     */
    protected static function defaultParams()
    {
        return [];
    }


    /**
     * Merge the default parameters with the given parameters.
     * @param $params
     *
     * @return array
     */
    protected static function mergeWithDefaultParams($params)
    {
        return array_merge(self::defaultParams(), $params);
    }
}
