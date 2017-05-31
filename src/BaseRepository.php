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
        return $this->collect($this->sdk->get($this->resource, $params));
    }

    /**
     * Update the resource
     * @param  array  $params [description]
     * @return array
     */
    public function update($id, $params = [])
    {
        return $this->collect($this->sdk->put($this->resource . '/' . $id, $params));
    }

    /**
     * Return the entire resource.
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->collect($this->sdk->get($this->resource));
    }

    /**
     * Find a result by key.
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->collect($this->sdk->get($this->resource . '/' . $id));
    }

    /**
     * Create a resource
     * @param $payload
     * @return mixed
     */
    public function create($payload)
    {
        $result = $this->collect($this->sdk->post($this->resource, $payload));
        return $result;
    }

    /**
     * Delete a resource
     * @param $payload
     * @return mixed
     */
    public function delete($payload)
    {
        $result = $this->collect($this->sdk->delete($this->resource, $payload));
        return $result;
    }

    /**
     * By default, return the data key if it exists.
     *
     * @param $response
     * @return mixed
     */
    protected function formatResponse($response) {
        return $response;
    }

    /**
     * Turn the data into and arrayable object.
     * @param  $data
     * @return Kumuwai\DataTransferObject\DTO
     */
    protected function collect($data)
    {
        return ($this->is_multi($data)) ? new Collection($data) : new Object($data);
    }

    protected function is_multi($a) {
        $rv = array_filter($a,'is_array');
        if(count($rv)>0) return true;
        return false;
    }
}