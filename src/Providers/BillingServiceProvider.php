<?php

namespace Dealskoo\Billing\Providers;

use Dealskoo\Billing\Models\Seller;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class BillingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Cashier::useCustomerModel(Seller::class);
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}
