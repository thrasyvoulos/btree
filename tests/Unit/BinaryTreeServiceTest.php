<?php


namespace Tests\Unit;


use App\Services\BinaryTreeOperations;
use App\Services\BinaryTreeService;
use Tests\TestCase;

class BinaryTreeServiceTest extends TestCase
{
    public function seedService()
    {
        return [
            'empty-case' => [
                '',
                []
            ],
            'normal-case' => [
                "1 1" . "\n" . "2 1" . "\n" . "2 2" . "\n" . "4 5",
                [
                    "input" => [
                        [
                            'generation' => 1,
                            'child' => 1
                        ],
                        [
                            'generation' => 2,
                            'child' => 1
                        ],
                        [
                            'generation' => 2,
                            'child' => 2
                        ],
                        [
                            'generation' => 4,
                            'child' => 5
                        ]
                    ],
                    "output" => [
                        'M',
                        'M',
                        'F',
                        'F'
                    ]
                ]
            ],
            'special-case' => [
                "200 1" . "\n" . "200 2",
                [
                    "input" => [
                        [
                            'generation' => 200,
                            'child' => 1
                        ],
                        [
                            'generation' => 200,
                            'child' => 2
                        ],
                    ],
                    "output" => [
                        'M',
                        'F'
                    ]
                ]
            ],
        ];
    }

    public function seedException()
    {
        return [
            'big-numbers-case' => [
                "78 55" . "\n" . "65 666",
                [
                    "input" => [
                        [
                            'generation' => 78,
                            'child' => 55
                        ],
                        [
                            'generation' => 65,
                            'child' => 666
                        ],
                    ],
                    "output" => [
                        'doesnt matter',
                        'doesnt matter'
                    ]
                ]
            ]
        ];
    }

    /**
     * @dataProvider seedService
     * @param $input
     */
    public function testResolve($input, $result)
    {
        $btreeOperations = new BinaryTreeOperations();
        $bs = new BinaryTreeService($btreeOperations);
        $this->assertEquals($bs->resolve($input), $result);
    }

    /**
     * @dataProvider seedException
     * @param $input
     * @param $result
     * @throws \Exception
     */
    public function testResolveException($input, $result)
    {
        $this->expectException(\Exception::class);
        $btreeOperations = new BinaryTreeOperations();
        $bs = new BinaryTreeService($btreeOperations);
        $this->assertEquals($bs->resolve($input), $result);
    }
}
