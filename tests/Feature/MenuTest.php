<?php

namespace Dealskoo\Billing\Tests\Feature;

use Dealskoo\Admin\Facades\AdminMenu;
use Dealskoo\Seller\Facades\SellerMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\Billing\Tests\Testcase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu()
    {
        $this->assertNotNull(SellerMenu::findBy('title', 'billing::billing.billing'));
        $childs = SellerMenu::findBy('title', 'billing::billing.billing')->getChilds();
        $menu = collect($childs)->where('title', 'billing::billing.plans');
        $this->assertNotEmpty($menu);
        $menu = collect($childs)->where('title', 'billing::billing.payment_methods');
        $this->assertNotEmpty($menu);
        $menu = collect($childs)->where('title', 'billing::billing.billing_portal');
        $this->assertNotEmpty($menu);
    }
}
