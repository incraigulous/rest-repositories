<?php

namespace Incraigulous\RestRepositories\Repositories\JsonPlaceholder;


use Incraigulous\RestRepositories\Repository;
use Incraigulous\RestRepositories\Sdks\JsonPlaceholderSdk;
use Incraigulous\RestRepositories\Traits\FindsFromList;
use Incraigulous\RestRepositories\Traits\HasAll;

class JsonPlaceholderPostsFindsByList extends Repository
{
    use FindsFromList, HasAll;

    public static $resource = 'posts';

    public static function sdk() {
        return new JsonPlaceholderSdk();
    }
}