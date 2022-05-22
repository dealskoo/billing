<?php

namespace Dealskoo\Billing\Providers;

use Dealskoo\Billing\Models\Seller;
use Dealskoo\Billing\Price;
use Dealskoo\Seller\Facades\SellerMenu;
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
        $this->mergeConfigFrom(__DIR__ . '/../../config/billing.php', 'billing');
        $this->app->singleton('price', Price::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../config/billing.php' => config_path('billing.php')
            ], 'config');

            $this->publishes([
                __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/billing')
            ], 'lang');

            $this->publishes([
                __DIR__ . '/../../resources/views/pricing' => resource_path('views/vendor/billing/pricing')
            ], 'views');
        }

        Cashier::useCustomerModel(Seller::class);
        $this->loadRoutesFrom(__DIR__ . '/../../routes/seller.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'billing');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'billing');

        SellerMenu::dropdown('billing::billing.billing', function ($menu) {
            $menu->route('seller.subscription.plans', 'billing::billing.plans');
            $menu->route('seller.payment.index', 'billing::billing.payment_methods');
            $menu->route('seller.subscription.portal', 'billing::billing.billing_portal', [], ['target' => '_blank']);
        }, ['icon' => 'uil-usd-circle me-1'])->order(99);
    }
}
