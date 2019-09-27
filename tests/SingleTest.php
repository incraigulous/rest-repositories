<?php

use Incraigulous\RestRepositories\Item;
use PHPUnit\Framework\TestCase;

use Incraigulous\RestRepositories\Repositories\JsonPlaceholder\JsonPlaceholderPostSingle;

class SingleTest extends TestCase
{
    /**
     * @test
     */
    public function test_it_can_get()
    {
        $post = JsonPlaceholderPostSingle::get();
        $this->assertInstanceOf(Item::class,$post);
    }
}