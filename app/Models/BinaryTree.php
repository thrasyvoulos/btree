<?php


namespace App\Models;


class BinaryTree
{
    /**
     * @var null|BinaryNode the root node of the tree
     */
    public $root;

    public function __construct()
    {
        $this->root = null;
    }


    /**
     * Builds a tree of the following fashion:
     *        1
             / \
            2   3
           / \  / \
          4  5 6   7
     * @param array $arr
     * @param BinaryNode|null $root
     * @param integer $i
     * @param integer $length
     * @param string $gender
     * @param int $depth
     * @return BinaryNode|null
     */
    public function buildTree(array $arr, ?BinaryNode $root, int $i, int $length, string $gender, $depth = 1): ?BinaryNode
    {
        if ($i < $length) {
            $temp = new BinaryNode($arr[$i]);
            $root = $temp;
            $leftGen = $rightGen = null;

            /*
             * Formula to assign the left and right children nodes
             * Given a parent of index i the left child is 2 * $i + 1 and the right child is 2 * $i + 2
             */
            $lft = 2 * $i + 1;
            $right = 2 * $i + 2;

            // assign gender to current node
            $root->gender = $gender;
            // assign depth to current node
            $root->depth = $depth;

            /*
             * If current node is Female this means that the left child should be Female and the right Male
             * and vice versa for current node Male
             */
            if ($root->gender === BinaryNode::FEMALE) {
                $rightGen = BinaryNode::MALE;
                $leftGen = BinaryNode::FEMALE;
            }
            if ($root->gender === BinaryNode::MALE) {
                $rightGen = BinaryNode::FEMALE;
                $leftGen = BinaryNode::MALE;
            }
            // build left and right nodes
            $root->addChildren(
                $this->buildTree($arr, $root->left, $lft, $length, $leftGen, $depth + 1),
                $this->buildTree($arr, $root->right, $right, $length, $rightGen, $depth + 1)
            );
        }
        $this->root = $root; // @todo evaluate if this is needed
        return $this->root;
    }

    /**
     * Extracts the wanted node
     * @param BinaryNode $root
     * @param array $coordinates
     * @return BinaryNode
     * @throws \Exception
     */
    private function process(BinaryNode $root, array $coordinates): BinaryNode
    {
        if (empty($coordinates)) {
            throw new \Exception('Coordinates for the node are not set');
        }
        $depth = $coordinates['generation'];

        if (!isset($coordinates['child'])) {
            throw new \Exception('Node coordinates for a given depth is not set');
        }
        $nodeInDepth = $coordinates['child'];

        $nodes = $this->traverse($root, $depth);
        // array is zero indexed
        return $nodes[$nodeInDepth - 1];
    }

    /**
     * @param BinaryNode $root
     * @param array $coordinates
     * @return string
     * @throws \Exception
     */
    public function findGender(BinaryNode $root, array $coordinates): string
    {
        if ($coordinates['generation'] === 1 || $coordinates['child'] === 1) {
            return BinaryNode::MALE;
        }
        // The second child of the most left part of the tree is always Female.
        if ($coordinates['child'] === 2) {
            return BinaryNode::FEMALE;
        }
        $res = $this->process($root, $coordinates);
        return $res->gender;
    }

    /**
     * Level order traversal of a tree given a depth
     * @param BinaryNode $root
     * @param int $level
     * @return array
     */
    private function traverse(BinaryNode $root, int $level = 1): array
    {
        $treeSlice = [];
        $this->preOrder($root, $treeSlice, $level);
        return $treeSlice;
    }

    /**
     * @param BinaryNode|null $node
     * @param array $treeSlice
     * @param int $depth
     */
    private function preOrder(?BinaryNode $node, array &$treeSlice, int $depth)
    {
        if ($node === null) {
            return false;
        }
        if ($node->depth === $depth) {
            $treeSlice[] = $node;
            return false;
        }
        $this->preOrder($node->left, $treeSlice, $depth);
        $this->preOrder($node->right, $treeSlice, $depth);
    }
}
