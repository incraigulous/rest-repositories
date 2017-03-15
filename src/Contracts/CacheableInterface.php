<?php 
namespace Incraigulous\RestRepositories\Contracts;

interface CacheableInterface
{

    /**
     * Overload calls to Incraigulous\RestRepositories\CacheInterceptor.
     */
    public function cache();

	/**
     * Execute and/or cache a callback.
     * @param callable $callback
     * @param array $params
     * @return mixed
     */
    public function callOrCached(callable $callback, $params = []);
   
   /**
     * Is the method cacheable?
     * @param $methodName
     * @return bool
     */
    public function shouldCacheMethod($methodName);
}