<?php
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public $collection = [
        [
            'test' => 'asdf',
            'test2' => 'teasdfasdfst',
        ],
        [
            'test' => 'asdasdffasdf',
            'test2' => 'teasdasdffasdfst',
        ]
    ];

    public $mixed = [
        [
            'test' => 'asdf',
            'test2' => [
                'test' => 'asdasdffasdf',
                'test2' => 'teasdasdffasdfst',
            ],
        ],
        [
            'test' => 'asdasdffasdf',
            'test2' => 'teasdasdffasdfst',
        ]
    ];


    public function getKeyedCollection() {
        return [
            'data' => $this->collection
        ];
    }

    public function getNested() {
        return [
            [
                'test' => 'asdf',
                'test2' => $this->collection
            ],
            [
                'test' => 'asdf',
                'test2' =>  $this->collection
            ]
        ];
    }

    public function getKeyedNested() {
        return [
            'data' => [
                [
                    'test' => 'asdf',
                    'test2' => [
                        'data' => $this->collection
                    ]
                ],
                [
                    'test' => 'asdf',
                    'test2' =>  [
                        'data' => $this->collection
                    ]
                ]
            ],
        ];
    }

    /**
     * @test
     * @group collections
     */
    public function test_it_collects_collections()
    {
        $collection = new \Incraigulous\RestRepositories\Collection($this->collection);
        $this->assertEquals($this->collection, $collection->toArray());
    }

    /**
     * @test
     * @group collections
     */
    public function test_it_collects_mixed()
    {
        $collection = new \Incraigulous\RestRepositories\Collection($this->mixed);
        $this->assertEquals($this->mixed, $collection->toArray());
    }

    /**
     * @test
     * @group collections
     */
    public function test_it_collects_nested()
    {
        $collection = new \Incraigulous\RestRepositories\Collection($this->getNested());
        $this->assertEquals($this->getNested(), $collection->toArray());
    }

    /**
     * @test
     * @group collections
     */
    public function it_json_encodes()
    {
        $collection = new \Incraigulous\RestRepositories\Collection($this->getNested());
        $this->assertEquals(json_encode($this->getNested()), $collection->toJson());
    }

    /**
     * @test
     * @group collections
     */
    public function it_handles_data_keys()
    {
        $collection = new \Incraigulous\RestRepositories\Collection($this->getKeyedCollection(), 'data');
        $this->assertEquals($this->collection, $collection->toArray());
    }

    /**
     * @test
     * @group collections
     */
    public function it_handles_nested_data_keys()
    {
        $collection = new \Incraigulous\RestRepositories\Collection($this->getKeyedNested(), 'data');
        $this->assertEquals($this->getNested(), $collection->toArray());
    }
}