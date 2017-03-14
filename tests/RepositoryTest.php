<?php
use PHPUnit\Framework\TestCase;

use Incraigulous\RestRepositories\Repositories\JsonPlaceholder\JsonPlaceholderPostsRepository;

class RepositoryTest extends TestCase
{
  /**
   * @test
   */
  public function test_it_can_get_all()
  {
    $repo = new JsonPlaceholderPostsRepository();
    $posts = $repo->all();
    $this->assertGreaterThan(0, count($posts));
  }

    /**
     * @test
     */
    public function test_it_can_update()
    {
        $repo = new JsonPlaceholderPostsRepository();
        $response = $repo->update(1, ['title' => 'foo', 'body' => 'bar']);
        $this->assertEquals('foo', $response->title);
        $this->assertEquals('1', $response->id);
    }

    /**
     * @test
     */
    public function test_it_can_delete()
    {
        $repo = new JsonPlaceholderPostsRepository();
        $response = $repo->update(1, ['title' => 'foo', 'body' => 'bar']);
        $this->assertEquals('foo', $response->title);
        $this->assertEquals('1', $response->id);
    }
}