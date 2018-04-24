<?php

namespace Incraigulous\RestRepositories\Repositories\JsonPlaceholder;

use Incraigulous\RestRepositories\Sdks\JsonPlaceholderSdk;
use Incraigulous\RestRepositories\Repository;
use Incraigulous\RestRepositories\Single;

class JsonPlaceholderSingle extends Single
{
    public static function sdk() {
        return new JsonPlaceholderSdk();
    }
}