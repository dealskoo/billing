<?php

namespace Dealskoo\Billing\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\Billing\Tests\TestCase;

class PricingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $response = $this->get(route('seller.pricing'));
        $response->assertStatus(200);
    }
}
