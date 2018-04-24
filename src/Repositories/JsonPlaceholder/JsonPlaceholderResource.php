<?php

namespace Incraigulous\RestRepositories\Repositories\JsonPlaceholder;

use Incraigulous\RestRepositories\Resource;
use Incraigulous\RestRepositories\Sdks\JsonPlaceholderSdk;
use Incraigulous\RestRepositories\Repository;

class JsonPlaceholderResource extends Resource
{
    public static function sdk() {
        return new JsonPlaceholderSdk();
    }
}