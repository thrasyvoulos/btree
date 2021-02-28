<?php


namespace App\Services\Interfaces;


interface BinaryTreeServiceInterface
{
    /**
     * @param string $content
     * @return mixed
     */
    public function resolve(string $content);
}
