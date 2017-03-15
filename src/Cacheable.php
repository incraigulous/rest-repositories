<?php

namespace Incraigulous\RestRepositories;

use Cache;

/**
 * The default cache interface is built for Laravel's cacher. 
 * 
 * If you're not using laravel you can either: 
 * - Provide a static \Cache class that implements Laravel's cache interface or
 * - Have your base repository implement Icraigulous/RestRepositories/Contracts/Cacher and build your own.
 */

trait Cacheable {
    protected $cacheTime = 10; //How long to cache.
    protected $cacheable = []; //The included methods can be cached. If no methods included, any method can be cached.
    protected $cacheExcept = []; //The included methods can not be cached.

    /**
     * Route the call through the cacher.
     */
    public function cache()
    {
        return new Cacher($this);
    }

    /**
     * Is the method cacheable?
     * @param $methodName
     * @return bool
     */
    public function shouldCacheMethod($methodName)
    {
        if ($this->excluded($methodName)) return false;
        if ($this->included($methodName)) return true;
        return false;
    }

    /**
     * Is the method excluded?
     * @param $methodName
     * @return bool
     */
    protected function excluded($methodName)
    {
        if (in_array($methodName, $this->cacheExcept)) return true;
        return false;
    }

    /**
     * Is the method in the included ($this->cache) array?
     * @param $methodName
     * @return bool
     */
    protected function included($methodName)
    {
        if (!count($this->cacheable)) return true;
        if (in_array($methodName, $this->cacheable)) return true;
        return false;
    }

    /**
     * Generate a cache key based on the current class and function name, or a base string.
     * @param null $baseString
     * @param array $params
     * @return string
     */
    protected function generateCacheKey($baseString = null, $params = [])
    {
        return md5(debug_backtrace()[1]['function'] . '_' . (!$baseString) ? get_class($this) . '_' . json_encode($params) : $baseString . '_' . json_encode($params));
    }

    /**
     * Execute and/or cache a callback.
     * @param callable $callback
     * @param array $params
     * @return mixed
     */
    public function callOrCached(callable $callback, $params = [])
    {
        $key = $this->generateCacheKey(debug_backtrace()[1]['function'] . get_class($this), $params);
        if (!Cache::has($key)) {
            $result = call_user_func($callback, $params);
            Cache::put($key, $result, $this->cacheTime);
        } else {
            $result = Cache::get($key);
        }
        return $result;
    }
}