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
     * @return Collection|Object
     */
    protected static function formatResponse($response) {
        return ResponseFormatter::format($response, static::$dataKey);
    }
}