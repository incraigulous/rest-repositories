<?php
/**
 * Base interface for all repositories
 */
namespace Incraigulous\RestRepositories\Contracts;

interface RepositoryInterface
{
    public function get($params = []);
    public function update($id, $params = []);
    public function all();
    public function find($id);
    public function create($payload);
    public function delete($payload);
}