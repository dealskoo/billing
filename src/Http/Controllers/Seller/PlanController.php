<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends SellerController
{
    public function index(Request $request)
    {
        $seller = $request->user();
        $year_plan = false;
        if ($seller && $seller->interval() == Str::upper('Year')) {
            $year_plan = true;
        }
        return view('billing::seller.plan.index', ['year_plan' => $year_plan]);
    }
}
