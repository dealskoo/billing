<?php

namespace Dealskoo\Billing\Tests\Feature\Seller;

use Dealskoo\Billing\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\Billing\Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_plans()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.subscription.plans'));
        $response->assertStatus(200);
    }

    public function test_portal()
    {
        $seller = Seller::factory()->create();
        $seller->createAsStripeCustomer();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.subscription.portal'));
        $response->assertStatus(302);
    }

    public function test_form()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.subscription.form', 'aaa'));
        $response->assertStatus(302);
    }

    public function test_store()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->post(route('seller.subscription.store'), [
            'price' => 'aaa',
            'payment_method' => 'payment'
        ]);
        $response->assertStatus(500);
    }

    public function test_swap()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.subscription.swap', 'bbb'));
        $response->assertStatus(302);
    }

    public function test_cancel()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.subscription.cancel'));
        $response->assertStatus(302);
    }

    public function test_resume()
    {
        $seller = Seller::factory()->create();
        $response = $this->actingAs($seller, 'seller')->get(route('seller.subscription.resume'));
        $response->assertStatus(302);
    }
}
