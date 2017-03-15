<?php 
namespace Incraigulous\RestRepositories;

use Incraigulous\RestRepositories\Contracts\SdkInterface;
use Kumuwai\DataTransferObject\DTO;

/**
* The base repository.
*/
abstract class BaseRepository
{
	protected $resource;
    protected $sdk;

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
     * Turn the data into and arrayable object.
     * @param  $data
     * @return Kumuwai\DataTransferObject\DTO
     */
    protected function collect($data) 
    {
    	return new DTO($data);
    }
}