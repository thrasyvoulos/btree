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
     * @var null|BinaryNode the parent node
     */
    public $parent;

    const MALE = 'M';
    const FEMALE = 'F';

    public function __construct($data)
    {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
        $this->gender = null;
        $this->parent = null;
    }

    public function addChildren($left, $right)
    {
        $this->left = $left;
        $this->right = $right;
    }
}
