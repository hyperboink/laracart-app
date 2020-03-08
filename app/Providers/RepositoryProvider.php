<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Cart\CartRepository;
use App\Repository\Cart\CartRepositoryInterface;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Binds Topup
        $this->app->bind(CartRepository::class, CartRepositoryInterface::class);
    }
}
