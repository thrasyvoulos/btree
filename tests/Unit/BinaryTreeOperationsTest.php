<?php


namespace Tests\Unit;


use App\Services\BinaryTreeOperations;
use Tests\TestCase;

class BinaryTreeOperationsTest extends TestCase
{
    public function seedMinMax()
    {
        return [
            [
                'input' => [
                    [
                        'generation' => 5,
                        'child' => 8,
                    ],
                    [
                        'generation' => 1,
                        'child' => 1,
                    ],
                    [
                        'generation' => 36,
                        'child' => 58,
                    ],
                    [
                        'generation' => 23,
                        'child' => 74,
                    ]
                ],
                'expected' => [
                    'maxGeneration' => 36,
                    'maxChild' => 74,
                ]
            ]
        ];
    }

    public function seedNumbers()
    {
        return [
            [
                1,
                false
            ],
            [
                2,
                false
            ],
            [
                10,
                false
            ],
            [
                20,
                false
            ],
            [
                30,
                false
            ],
            [
                50,
                false
            ],
            [
                70,
                true
            ]
        ];
    }

    /**
     * @dataProvider seedNumbers
     * @param $input
     * @param $expectedResult
     */
    public function testInfinity($input, $expectedResult)
    {
        $bto = new BinaryTreeOperations();
        $inf = $bto->checkInfinity($input);
        $this->assertEquals($inf, $expectedResult);
    }

    /**
     * @dataProvider seedMinMax
     * @param $input
     * @param $expectedResult
     */
    public function testMinMax($input, $expectedResult)
    {
        $bto = new BinaryTreeOperations();
        $maxGen = $bto->getMax($input);
        $maxChild = $bto->getMax($input, 'child');
        $this->assertEquals($maxGen, $expectedResult['maxGeneration']);
        $this->assertEquals($maxChild, $expectedResult['maxChild']);
    }
}
