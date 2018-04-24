<?php
use PHPUnit\Framework\TestCase;

use Incraigulous\RestRepositories\Repositories\JsonPlaceholder\JsonPlaceholderPostsListing;

class ListingTest extends TestCase
{  /**
     * @test
     */
    public function test_it_can_get_all()
    {
        $posts = JsonPlaceholderPostsListing::all();
        $this->assertGreaterThan(0, count($posts));
    }

    /**
     * @test
     */
    public function test_it_can_find()
    {
        $post = JsonPlaceholderPostsListing::find(1);
        $this->assertInstanceOf(\Incraigulous\RestRepositories\Object::class, $post);
    }

    /**
     * @test
     */
    public function test_it_can_get()
    {
        $post = JsonPlaceholderPostsListing::get();
        $this->assertGreaterThan(0, count($post));
    }
}