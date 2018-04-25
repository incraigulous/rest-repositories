<?php
/**
 * FindsFromListTest.php
 * This is a short description of what's included in this file.
 */
use \Incraigulous\RestRepositories\Repositories\JsonPlaceholder\JsonPlaceholderPostsFindsByList;
use \PHPUnit\Framework\TestCase;

class FindsFromListTest extends TestCase
{
    /**
     * @test
     * @group traits
     */
    public function itCanFindFromList()
    {
        $post = JsonPlaceholderPostsFindsByList::all()->random();
        $result = JsonPlaceholderPostsFindsByList::find($post->id);
        $this->assertEquals($post, $result);

    }
}