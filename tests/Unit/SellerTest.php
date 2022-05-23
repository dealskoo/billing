<?php

namespace Dealskoo\Billing\Tests\Unit;

use Dealskoo\Billing\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\Billing\Tests\TestCase;

class SellerTest extends TestCase
{
    use RefreshDatabase;

    public function test_interval()
    {
        $seller = Seller::factory()->create();
        $this->assertNotNull($seller->interval());
    }

    public function test_plan()
    {
        $seller = Seller::factory()->create();
        $this->assertNull($seller->plan());
    }

    public function test_plan_name()
    {
        $seller = Seller::factory()->create();
        $this->assertNull($seller->plan_name());
    }
}
