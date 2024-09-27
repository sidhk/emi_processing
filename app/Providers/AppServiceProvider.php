<?php

namespace App\Providers;

use App\Repositories\LoanDetailsRepository;
use App\Repositories\Contracts\LoanDetailsRepositoryInterface;
use App\Repositories\EMIDetailsRepository;
use App\Repositories\Contracts\EMIDetailsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            LoanDetailsRepositoryInterface::class,
            LoanDetailsRepository::class
        );

        $this->app->bind(
            EMIDetailsRepositoryInterface::class,
            EMIDetailsRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

/*
public function register()
{
    $this->app->bind(InventoryRepositoryInterface::class, function ($app) {
        return new InventoryRepository(new Inventory());
    });
} */