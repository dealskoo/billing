<?php

namespace Dealskoo\Billing\Tests;

use Dealskoo\Billing\Providers\BillingServiceProvider;

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
        return [];
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
