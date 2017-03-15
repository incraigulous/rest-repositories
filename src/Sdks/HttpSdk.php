<?php
namespace Incraigulous\RestRepositories\Sdks;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Incraigulous\RestRepositories\Contracts\SdkInterface;

/**
 * A generic http sdk.
 * 
 * This can be extended to make specific API implementations.
 * 
 * For more robust customizations, you can also 
 * implement Incraigulous\RestRepositories\Contracts\SdkInterface
 */
class HttpSdk implements SdkInterface
{
    protected $endpoint = '';
    protected $options = [];
    protected $client;

    function __construct($endpoint = '', $options = [])
    {
        if ($endpoint) $this->endpoint = $endpoint;
        $this->options = $options;
        $this->setup();
    }

    /**
     * Do anything that needs when the SDK is instantiated.
     */
    protected function setup()
    {
        $this->client = new Client([
            'base_uri' => $this->endpoint,
            'headers' => $this->defaultHeaders()
        ]);
    }

    /**
     * Set any default headers here.
     */
    protected function defaultHeaders()
    {
    	return (!empty($this->options['headers'])) ? $this->options['headers'] : [];
    }

    /**
     * Make a get request.
     * @param $resource
     * @param array $params
     * @param array $headers
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function get($resource, array $params = [], array $headers = [])
    {
        $response = $this->client->get($resource, [
            'query' => $params,
            'headers' => $headers
        ]);
        return $this->formatResponse($response);
    }

    /**
     * Make a post request
     * @param $resource
     * @param $payload
     * @param array $headers
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function post($resource, array $payload = [], array $headers = [])
    {
        $response = $this->client->post($this->endpoint . $resource, [
            'form_params' => $payload,
            'headers' => $headers
        ]);
        return $this->formatResponse($response);
    }

    /**
     * Make a put request
     * @param $resource
     * @param $payload
     * @param array $headers
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function put($resource, array $payload = [], array $headers = [])
    {
        $response = $this->client->put($this->endpoint . $resource, [
            'form_params' => $payload,
            'headers' => $headers
        ]);
        return $this->formatResponse($response);
    }

    /**
     * Make a delete request
     * @param $resource
     * @param $params
     * @param array $headers
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function delete($resource, array $params = [], array $headers = [])
    {
        $response = $this->client->delete($this->endpoint . $resource, [
            'query' => $params,
            'headers' => $headers
        ]);
        return $this->formatResponse($response);
    }


    /**
     * Transform the response to and array (or whatever you want the result to be)
     * @param Response $response
     * @return mixed
     */
    protected function formatResponse(Response $response)
    {
        return json_decode($response->getBody(), true);
    }
}