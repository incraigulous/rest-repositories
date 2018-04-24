<?php
/**
 * Resource.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories;


use Incraigulous\RestRepositories\Traits\HasAll;
use Incraigulous\RestRepositories\Traits\HasCreate;
use Incraigulous\RestRepositories\Traits\HasDelete;
use Incraigulous\RestRepositories\Traits\HasFind;
use Incraigulous\RestRepositories\Traits\HasGet;
use Incraigulous\RestRepositories\Traits\HasUpdate;

/**
 * Class Resource
 *
 * @package Incraigulous\RestRepositories
 */
abstract class Resource extends Repository
{
    use HasAll, HasCreate, HasDelete, HasFind, HasGet, HasUpdate;

}