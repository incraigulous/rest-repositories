<?php
/**
 * Single.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories;
use Incraigulous\RestRepositories\Traits\HasGet;


/**
 * Class Single
 *
 * @package Incraigulous\RestRepositories
 */
abstract class Single extends Repository
{
    use HasGet;
}