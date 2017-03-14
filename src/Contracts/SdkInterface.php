<?php
/**
 * Base interface for all repositories
 */
namespace Incraigulous\RestRepositories\Contracts;

interface SdkInterface
{
    public function get($resource, array $params = [], array $headers = []);
    public function post($resource, array $payload = [], array $headers = []);
    public function put($resource, array $payload = [], array $headers = []);
    public function delete($resource, array $params = [], array $headers = []);
}