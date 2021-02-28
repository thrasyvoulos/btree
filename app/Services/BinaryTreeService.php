<?php


namespace App\Services;


use App\Models\BinaryNode;
use App\Models\BinaryTree;
use App\Services\Interfaces\BinaryTreeOperationsInterface;
use App\Services\Interfaces\BinaryTreeServiceInterface;
use Illuminate\Support\Facades\Redis;
use SplFixedArray;

class BinaryTreeService implements BinaryTreeServiceInterface
{
    /**
     * @var BinaryTreeOperationsInterface
     */
    protected $btreeOperations;

    public function __construct(BinaryTreeOperationsInterface $btreeOperations)
    {
        $this->btreeOperations = $btreeOperations;
    }

    /**
     * @param string $content
     * @return array
     * @throws \Exception
     */
    public function resolve(string $content): array
    {
        $processedResult = $this->btreeOperations->processInput($content);
        if ($processedResult === []) {
            return [];
        }
        $maxChild = $this->btreeOperations->getMax($processedResult, 'child');
        // there is no point on building the tree if max value of children is 1 or 2
        if ((int)$maxChild < 3) {
            return $this->skipTree($processedResult);
        }
        $max = $this->btreeOperations->getMax($processedResult);
        $min = $this->btreeOperations->getMin($processedResult);

        // The second comparison is a bit wrong. Because we skip the in between nodes that may not have reached infinity.
        // @todo find a way to skip infinity numbers and rebuild the tree for the rest
        if ($this->btreeOperations->checkInfinity((int)$min) === true || $this->btreeOperations->checkInfinity((int)$max) === true) {
            throw new \Exception('Infinity reached. Avengers assemble');
        }
        $treeNodes = $this->btreeOperations->populate($max);
        return $this->generateTree($treeNodes, $processedResult);

    }

    /**
     * Map the input to Male or Female depending on the position
     * @param array $input
     * @return array
     */
    private function skipTree(array $input): array
    {
        $output = array_map(
            function ($key) {
                // the most left part of the tree is always Male. So is the top parent
                if ((int)$key['generation'] === 1 || (int)$key['child'] === 1) {
                    return BinaryNode::MALE;
                }
                // The second child of the most left part of the tree is always Female.
                if ((int)$key['child'] === 2) {
                    return BinaryNode::FEMALE;
                }
            },
            $input
        );
        return [
            'input' => $input,
            'output' => $output
        ];
    }

    /**
     * @param SplFixedArray $treeNodes
     * @param array $processedResult
     * @return array
     * @throws \Exception
     */
    private function generateTree(\SplFixedArray $treeNodes, array $processedResult): array
    {
        // fetch from redis
        if (($tree = Redis::get('redis_tree' . $treeNodes->getSize())) !== null) {
            return json_decode($tree, true);
        }
        $tree = new BinaryTree();
        $tree->buildTree($treeNodes->toArray(), null, 0, $treeNodes->getSize(), BinaryNode::MALE, null);
        $output = [];
        foreach ($processedResult as $result) {
            $output[] = $tree->findGender($tree->root, $result);
        }
        $result = [
            'input' => $processedResult,
            'output' => $output
        ];
        // store in redis. Save some time if we already have generated the tree for a given size
        Redis::set('redis_tree' . $treeNodes->getSize(), json_encode($result));
        return $result;
    }
}
