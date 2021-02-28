<?php


namespace Tests\Unit;


use App\Models\BinaryTree;
use App\Services\BinaryTreeOperations;
use Tests\TestCase;

class BinaryTreeTest extends TestCase
{
    public function seedTree()
    {
        return [
            [
                'input-tree' => [
                    [
                        'generation' => 5,
                        'child' => 8,
                    ]
                ],
                'coordinates-to-locate-gender' => [
                    'cc' => [
                        'generation' => 4,
                        'child' => 5,
                    ]
                ],
                'F'
            ],
            [
                'input-tree' => [
                    [
                        'generation' => 5,
                        'child' => 8,
                    ]
                ],
                'coordinates-to-locate-gender' => [
                    'cc' => [
                        'generation' => 3,
                        'child' => 4,
                    ]
                ],
                'M'
            ],
            [
                'input-tree' => [
                    [
                        'generation' => 10,
                        'child' => 22,
                    ]
                ],
                'coordinates-to-locate-gender' => [
                    'cc' => [
                        'generation' => 9,
                        'child' => 16,
                    ]
                ],
                'M'
            ],

        ];
    }

    /**
     * @dataProvider seedTree
     *
     * @param $input
     * @param $coordinates
     * @param $expectedResult
     * @return void
     * @throws \Exception
     */
    public function testTree($input, $coordinates, $expectedResult)
    {
        $bto = new BinaryTreeOperations();
        $max = $bto->getMax($input);
        $treeNodes = $bto->populate($max);

        $pp = new BinaryTree();
        $pp->buildTree($treeNodes->toArray(), null, 0, $treeNodes->getSize(), 'M', null);
        $res = $pp->findGender(
            $pp->root,
            $coordinates['cc']
        );
        $this->assertEquals($res, $expectedResult);
    }
}
