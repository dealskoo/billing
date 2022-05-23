<?php

namespace Dealskoo\Billing\Tests\Feature\Seller;

use Dealskoo\Billing\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\Billing\Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.payment.index'));
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->post(route('seller.payment.store'), [
            'payment_method' => 'payment'
        ]);
        $response->assertStatus(500);
    }

    public function test_update()
    {
        $seller = Seller::factory()->create();
        $seller->createAsStripeCustomer();
        $response = $this->actingAs($seller, 'seller')->put(route('seller.payment.update', 'payment'));
        $response->assertStatus(500);
    }

    public function test_destroy()
    {
        $seller = Seller::factory()->create();
        $seller->createAsStripeCustomer();
        $response = $this->actingAs($seller, 'seller')->delete(route('seller.payment.destroy', 'payment'));
        $response->assertStatus(500);
    }
}
