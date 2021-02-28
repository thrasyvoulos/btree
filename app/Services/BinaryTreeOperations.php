<?php


namespace App\Services;


use App\Services\Interfaces\BinaryTreeOperationsInterface;
use SplFixedArray;

class BinaryTreeOperations implements BinaryTreeOperationsInterface
{

    /**
     * @param string $input
     * @return array
     */
    public function processInput(string $input): array
    {
        $input = explode("\n", $input);
        if (empty(array_filter($input))) {
            return [];
        }
        $res = [];
        foreach ($input as $key => $line) {
            $xp = explode(" ", $line);
            $res[$key]['generation'] = $xp[0];
            $res[$key]['child'] = $xp[1];
        }
        return $res;
    }

    public function populate($input)
    {
        $numNodes = $this->calculateNodes($input);
        return $this->populateNodesArray($numNodes);
    }

    /**
     * Check if a number of 2^$i will reach infinity
     * @param $input
     * @return bool
     */
    public function checkInfinity($input): bool
    {
        $res = pow(2, $input);
        return is_infinite($res) || is_float($res);
    }

    public function getMin($input, $column = 'generation')
    {
        return min(array_column($input, $column));
    }

    public function getMax($input, $column = 'generation')
    {
        return max(array_column($input, $column));
    }

    /**
     * Calculate the total number of nodes the tree will have
     * @param int $generation
     * @return float|int
     */
    private function calculateNodes(int $generation)
    {
        $length = 0;
        for ($i = 0; $i <= $generation; $i++) {
            $length += pow(2, $i);
        }
        return $length;
    }

    /**
     * Returns a populated array with the nodes
     * @param int $numOfNodes
     * @return SplFixedArray $numOfNodes
     */
    private function populateNodesArray(int $numOfNodes): SplFixedArray
    {
        $fixedArray = new SplFixedArray($numOfNodes);
        for ($i = 0; $i < $numOfNodes; $i++) {
            $fixedArray[$i] = $i + 1;
        }
        return $fixedArray;
    }
}
