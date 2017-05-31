<?php
namespace Incraigulous\RestRepositories;

use Incraigulous\RestRepositories\Contracts\RepositoryInterface;
use Incraigulous\RestRepositories\Contracts\SdkInterface;


/**
 * The base repository.
 */
abstract class BaseRepository implements RepositoryInterface
{
    protected $resource;
    protected $sdk;
    protected $dataKey;

    function __construct(SdkInterface $sdk = null)
    {
        $this->sdk = $sdk;
        $this->setup();
    }

    //Do whatever bootstrapping needed to get the repo up and running.
    protected function setup() {
        //To use in child classes
    }

    /**
     * Get the resource.
     * @param  array  $params [description]
     * @return array
     */
    public function get($params = [])
    {
        return $this->formatResponse($this->sdk->get($this->resource, $params));
    }

    /**
     * Update the resource
     * @param  array  $params [description]
     * @return array
     */
    public function update($id, $params = [])
    {
        return $this->formatResponse($this->sdk->put($this->resource . '/' . $id, $params));
    }

    /**
     * Return the entire resource.
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->formatResponse($this->sdk->get($this->resource));
    }

    /**
     * Find a result by key.
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->formatResponse($this->sdk->get($this->resource . '/' . $id));
    }

    /**
     * Create a resource
     * @param $payload
     * @return mixed
     */
    public function create($payload)
    {
        $result = $this->formatResponse($this->sdk->post($this->resource, $payload));
        return $result;
    }

    /**
     * Delete a resource
     * @param $payload
     * @return mixed
     */
    public function delete($payload)
    {
        $result = $this->formatResponse($this->sdk->delete($this->resource, $payload));
        return $result;
    }

    /**
     * Format the response.
     * @param $response
     * @return Collection|Object
     */
    protected function formatResponse($response) {
        return $this->objectify($response);
    }

    /**
     * Turn the data into nested collections or an arrayable object.
     * @param $data
     * @return Collection|Object
     */
    protected function objectify($data)
    {
        $data = ($this->dataKey) ? $data[$this->dataKey] : $data;
        return ($this->isAssoc($data)) ? new Object($data) : new Collection($data);
    }

    protected function isAssoc($arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}