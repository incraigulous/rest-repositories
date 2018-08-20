<?php
use \PHPUnit\Framework\TestCase;
use \Incraigulous\RestRepositories\Repositories\JsonPlaceholder\JsonPlaceholderFailListing;

class FailureTest extends TestCase
{
    /**
     * @test
     * @group traits
     */
    public function allFailsGracefully()
    {
        $posts = JsonPlaceholderFailListing::all();
        $this->assertNull($posts);
    }

    /**
     * @test
     * @group traits
     */
    public function allFails()
    {
        try {
            $result = JsonPlaceholderFailListing::allOrFail();
        } catch (Exception $exception) {
            $result = 'failed';
        }
        $this->assertEquals('failed', $result);
    }

    /**
     * @test
     * @group traits
     */
    public function getFailsGracefully()
    {
        $posts = JsonPlaceholderFailListing::get();
        $this->assertNull($posts);
    }

    /**
     * @test
     * @group traits
     */
    public function getFails()
    {
        try {
            $result = JsonPlaceholderFailListing::getOrFail();
        } catch (Exception $exception) {
            $result = 'failed';
        }
        $this->assertEquals('failed', $result);
    }

    /**
     * @test
     * @group traits
     */
    public function FindFailsGracefully()
    {
        $posts = JsonPlaceholderFailListing::find(1);
        $this->assertNull($posts);
    }

    /**
     * @test
     * @group traits
     */
    public function findFails()
    {
        try {
            $result = JsonPlaceholderFailListing::findOrFail(1);
        } catch (Exception $exception) {
            $result = 'failed';
        }
        $this->assertEquals('failed', $result);
    }
}
