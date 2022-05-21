<?php

namespace Dealskoo\Billing\Providers;

use Dealskoo\Admin\Facades\AdminMenu;
use Dealskoo\Admin\Facades\PermissionManager;
use Dealskoo\Admin\Permission;
use Dealskoo\Billing\Models\Seller;
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
                __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/billing')
            ], 'lang');
        }

        Cashier::useCustomerModel(Seller::class);
        Cashier::calculateTaxes();

        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/seller.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'billing');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'billing');

        AdminMenu::dropdown('billing::billing.billing', function ($menu) {

        }, ['icon' => 'uil-usd-circle', 'permission' => 'billing.billing'])->order(98);

        PermissionManager::add(new Permission('billing.billing', 'Billing'));

        SellerMenu::dropdown('billing::billing.billing', function ($menu) {
            $menu->route('seller.plans.index', 'billing::billing.plans');
            $menu->route('seller.invoices.index', 'billing::billing.invoices');
            $menu->route('seller.subscription.history', 'billing::billing.subscription_history');
        }, ['icon' => 'uil-usd-circle me-1'])->order(99);
    }
}
