<?php

namespace Dealskoo\Billing\Http\Controllers;

use Dealskoo\Billing\Facades\Price;
use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PricingController extends SellerController
{

    public function index(Request $request)
    {
        $seller = $request->user('seller');
        $year_plan = false;
        if ($seller && $seller->interval() == Str::upper('Year')) {
            $year_plan = true;
        }
        return view('billing::pricing.index', ['year_plan' => $year_plan]);
    }
}
