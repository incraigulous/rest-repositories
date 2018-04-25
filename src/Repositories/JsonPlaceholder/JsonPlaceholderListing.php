<?php

namespace Incraigulous\RestRepositories\Repositories\JsonPlaceholder;

use Incraigulous\RestRepositories\Listing;
use Incraigulous\RestRepositories\Sdks\JsonPlaceholderSdk;

class JsonPlaceholderListing extends Listing
{

    public static function sdk() {
        return new JsonPlaceholderSdk();
    }
}