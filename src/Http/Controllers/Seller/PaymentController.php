<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;

class PaymentController extends SellerController
{
    public function methods(Request $request)
    {
        return view('billing::seller.payment.methods', ['intent' => $request->user()->createSetupIntent()]);
    }
}

