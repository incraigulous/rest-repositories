<?php

namespace Incraigulous\RestRepositories\Repositories\JsonPlaceholder;

use Incraigulous\RestRepositories\Sdks\JsonPlaceholderSdk;
use Incraigulous\RestRepositories\BaseRepository;

class JsonPlaceholderBaseRepository extends BaseRepository
{
    public function setup() {
        $this->sdk = new JsonPlaceholderSdk();
    }
}