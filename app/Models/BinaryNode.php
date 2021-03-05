<?php


namespace App\Models;


class BinaryNode
{
    /**
     * @var int data of node
     */
    public $data;

    /**
     * @var null|self left node child of parent node
     */
    public $left;

    /**
     * @var null|self right child of parent node
     */
    public $right;

    /**
     * @var null|string gender of node
     */
    public $gender;

    /**
     * @var null|int depth of node
     */
    public $depth;

    const MALE = 'M';
    const FEMALE = 'F';

    public function __construct($data)
    {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
        $this->gender = null;
        $this->depth = null;
    }

    /**
     * @param $left
     * @param $right
     */
    public function addChildren(?BinaryNode $left, ?BinaryNode $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    /**
     * @param int $depth
     */
    public function setDepth(int $depth)
    {
        $this->depth = $depth;
    }
}
