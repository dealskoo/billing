<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class InvoiceController extends SellerController
{
    public function index(Request $request)
    {
//        $paymentIntent = Cashier::stripe()->paymentIntents->create(['amount' => 1400, 'currency' => 'usd', 'automatic_payment_methods' => ['enabled' => true]]);
//        return view('billing::seller.invoice.index', ['clientSecret' => $paymentIntent->client_secret]);
        $subscription = Cashier::stripe()->subscriptions->create([
            'customer' => $request->user()->stripe_id,
            'items' => [['price' => config('billing.plans.month.lite.stripe_id')]],
            'payment_behavior' => 'default_incomplete',
            'expand' => ['latest_invoice.payment_intent'],
        ]);
        return view('billing::seller.invoice.index', ['clientSecret' => $subscription->latest_invoice->payment_intent->client_secret]);
    }
}
