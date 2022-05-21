<?php

namespace Dealskoo\Billing\Http\Controllers;

use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;

class PricingController extends SellerController
{

    public function index(Request $request)
    {
        return view('billing::pricing.index');
    }
}
