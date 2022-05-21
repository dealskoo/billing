<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;

class PaymentController extends SellerController
{
    public function index(Request $request)
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
        return redirect(route('seller.payment.index'));
    }

    public function update(Request $request, $id)
    {
        $request->user()->updateDefaultPaymentMethod($id);
        return redirect(route('seller.payment.index'));
    }

    public function destroy(Request $request, $id)
    {
        $request->user()->deletePaymentMethod($id);
        return redirect(route('seller.payment.index'));
    }
}

