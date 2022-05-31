<?php

namespace Dealskoo\Billing\Tests;

use Dealskoo\Billing\Facades\Price;
use Dealskoo\Billing\Providers\BillingServiceProvider;
use Dealskoo\Billing\Tests\Http\Kernel;

abstract class TestCase extends \Dealskoo\Seller\Tests\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            BillingServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Price' => Price::class
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton(\Illuminate\Contracts\Http\Kernel::class, Kernel::class);
    }
}
