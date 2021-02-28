<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class BinaryTreeOperationsProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Services\Interfaces\BinaryTreeOperationsInterface',
            'App\Services\BinaryTreeOperations'
        );
    }
}
