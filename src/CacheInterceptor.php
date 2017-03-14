<?php
namespace Incraigulous\RestRepositories;

use Incraigulous\RestRepositories\Contracts\RepositoryInterface;

class CacheInterceptor
{
    protected $repository;
    
    function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     *  Call the called method on the repository. If it's cacheable, try to get it from cache first.
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ($this->repository->shouldCacheMethod($name)) {
            return $this->repository->callOrCached(function() use ($name, $arguments) {
                return call_user_func_array([$this->repository, $name], $arguments);
            }, $arguments);
        }
        return call_user_func_array([$this->repository, $name], $arguments);
    }
}