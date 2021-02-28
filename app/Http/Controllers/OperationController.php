<?php


namespace App\Http\Controllers;


use App\Http\Requests\BtreeRequest;
use App\Services\Interfaces\BinaryTreeServiceInterface;
use Illuminate\Support\Facades\Redis;

/**
 * ApiController to process the request
 * Class OperationController
 * @package App\Http\Controllers
 */
class OperationController extends Controller
{
    protected $btree;

    /**
     * @param BinaryTreeServiceInterface $btree
     */
    public function __construct(BinaryTreeServiceInterface $btree)
    {
        $this->btree = $btree;
    }

    /**
     * @param BtreeRequest $request
     * @return object the BtreeService
     */
    public function create(BtreeRequest $request)
    {
        return $this->btree->resolve($request->file('file')->getContent());
    }
}
