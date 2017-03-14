<?php
use PHPUnit\Framework\TestCase;

use Incraigulous\RestRepositories\Sdks\JsonPlaceholderSdk;

class SdkTest extends TestCase
{
  /**
   * @test
   */
  public function test_it_can_get()
  {
    $sdk = new JsonPlaceholderSdk();
    $posts = $sdk->get('posts');
    $this->assertGreaterThan(0, count($posts));
  }

    /**
     * @test
     */
    public function test_it_can_post()
    {
        $sdk = new JsonPlaceholderSdk();
        $result = $sdk->post('posts', ['title' => 'foo', 'body' => 'bar', 'userId' => 1]);
        $this->assertEquals('foo', $result['title']);
    }

    /**
     * @test
     */
    public function test_it_can_put()
    {
        $sdk = new JsonPlaceholderSdk();
        $result = $sdk->put('posts/1', ['title' => 'foo', 'body' => 'bar', 'userId' => 1]);
        $this->assertEquals('foo', $result['title']);
        $this->assertEquals('1', $result['id']);
    }

    /**
     * @test
     */
    public function test_it_can_delete()
    {
        $sdk = new JsonPlaceholderSdk();
        $result = $sdk->delete('posts/1');
        $this->assertTrue(is_array($result));
    }
}