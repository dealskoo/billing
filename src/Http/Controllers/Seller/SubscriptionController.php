<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Billing\Facades\Price;
use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;

class SubscriptionController extends SellerController
{
    public function index(Request $request)
    {
        return view('billing::seller.subscription.history');
    }

    public function form(Request $request, $id)
    {
        if (count($request->user()->paymentMethods()) <= 0) {
            return redirect(route('seller.payment.index'));
        }
        $methods = $request->user()->paymentMethods();
        $price = Price::price($id);
        $product = Price::product($id);
        $plan = Price::plan($id);
        $default = $request->user()->defaultPaymentMethod();
        return view('billing::seller.subscription.form', ['price' => $price, 'product' => $product, 'plan' => $plan, 'default' => $default, 'methods' => $methods]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => ['required', 'string'],
            'payment_method' => ['required', 'string']
        ]);
        
    }
}
