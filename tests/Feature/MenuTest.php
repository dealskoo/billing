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
        $this->assertNotNull(AdminMenu::findBy('title', 'billing::billing.billing'));
        $childs = AdminMenu::findBy('title', 'billing::billing.billing')->getChilds();
//        $menu = collect($childs)->where('title', 'billing::billing.billing');
//        $this->assertNotEmpty($menu);

        $this->assertNotNull(SellerMenu::findBy('title', 'billing::billing.billing'));
        $childs = SellerMenu::findBy('title', 'billing::billing.billing')->getChilds();
//        $menu = collect($childs)->where('title', 'billing::billing.billing');
//        $this->assertNotEmpty($menu);
    }
}
