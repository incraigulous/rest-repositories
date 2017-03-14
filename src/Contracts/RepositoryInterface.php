<?php
/**
 * Base interface for all repositories
 */
namespace Incraigulous\RestRepositories\Contracts;

interface RepositoryInterface
{
	public function get($params = []);
	public function update($params = []);
    public function all();
    public function create($payload);
    public function delete($payload);
}