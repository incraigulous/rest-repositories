<?php
use PHPUnit\Framework\TestCase;

use Incraigulous\RestRepositories\Repositories\JsonPlaceholder\JsonPlaceholderPostSingle;

class SingleTest extends TestCase
{
    /**
     * @test
     */
    public function test_it_can_get()
    {
        $posts = JsonPlaceholderPostSingle::get();
        $this->assertGreaterThan(0, count($posts));
    }
}