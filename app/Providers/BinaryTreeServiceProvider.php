<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class BinaryTreeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Services\Interfaces\BinaryTreeServiceInterface',
            'App\Services\BinaryTreeService'
        );
    }
}
