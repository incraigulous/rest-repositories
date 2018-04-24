<?php
use PHPUnit\Framework\TestCase;

use Incraigulous\RestRepositories\Repositories\JsonPlaceholder\JsonPlaceholderPostsResource;

class ResourceTest extends TestCase
{  /**
     * @test
     */
    public function test_it_can_get_all()
    {
        $posts = JsonPlaceholderPostsResource::all();
        $this->assertGreaterThan(0, count($posts));
    }

    /**
     * @test
     */
    public function test_it_can_find()
    {
        $post = JsonPlaceholderPostsResource::find(1);
        $this->assertInstanceOf(\Incraigulous\RestRepositories\Object::class, $post);
    }

    /**
     * @test
     */
    public function test_it_can_get()
    {
        $posts = JsonPlaceholderPostsResource::get();
        $this->assertGreaterThan(0, count($posts));
    }


    /**
     * @test
     */
    public function test_it_can_update()
    {
        $response = JsonPlaceholderPostsResource::update(1, ['title' => 'foo', 'body' => 'bar']);
        $this->assertEquals('foo', $response->title);
        $this->assertEquals('1', $response->id);
    }

    /**
     * @test
     */
    public function test_it_can_create()
    {
        $response = JsonPlaceholderPostsResource::create(['title' => 'foo', 'body' => 'bar']);
        $this->assertEquals('foo', $response->title);
    }

    /**
     * @test
     */
    public function test_it_can_delete()
    {
        $response = JsonPlaceholderPostsResource::update(1, ['title' => 'foo', 'body' => 'bar']);
        $this->assertEquals('foo', $response->title);
        $this->assertEquals('1', $response->id);
    }
}