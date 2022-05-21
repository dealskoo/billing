<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;

class PaymentController extends SellerController
{
    public function methods(Request $request)
    {
        $methods = $request->user()->paymentMethods();
        $default = $request->user()->defaultPaymentMethod();
        return view('billing::seller.payment.methods', ['intent' => $request->user()->createSetupIntent(), 'methods' => $methods, 'default' => $default]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => ['required']
        ]);
        $user = $request->user();
        if (!$user->hasStripeId()) {
            $user->createAsStripeCustomer();
        }
        $paymentMethod = $request->input('payment_method');
        $user->addPaymentMethod($paymentMethod);
        $user->updateDefaultPaymentMethod($paymentMethod);
        return redirect(route('seller.payment.methods'));
    }
}

