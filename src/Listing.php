<?php
/**
 * Listing.php
 * This is a short description of what's included in this file.
 */

namespace Incraigulous\RestRepositories;


use Incraigulous\RestRepositories\Traits\HasAll;
use Incraigulous\RestRepositories\Traits\HasFind;
use Incraigulous\RestRepositories\Traits\HasGet;

abstract class Listing extends Repository
{
    use HasAll, HasGet, HasFind;
}