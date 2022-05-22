<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Billing\Facades\Price;
use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Exceptions\IncompletePayment;

class SubscriptionController extends SellerController
{
    public function plans(Request $request)
    {
        $seller = $request->user();
        $year_plan = false;
        if ($seller && $seller->interval() == Str::upper('Year')) {
            $year_plan = true;
        }
        return view('billing::seller.subscription.plans', ['year_plan' => $year_plan]);
    }

    public function portal(Request $request)
    {
        return $request->user()->redirectToBillingPortal(route('seller.dashboard'));
    }

    public function form(Request $request, $id)
    {
        $products = Cashier::stripe()->products->all();
        if ($request->user()->subscribedToProduct(Price::products(), 'default')) {
            return redirect(route('seller.dashboard'));
        }
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
        if ($request->user()->subscribedToProduct(Price::products(), 'default')) {
            return redirect(route('seller.dashboard'));
        }
        $request->validate([
            'price' => ['required', 'string'],
            'payment_method' => ['required', 'string']
        ]);
        try {
            if ($request->input('promotion_code')) {
                $request->user()->newSubscription('default', $request->input('price'))->withCoupon($request->input('promotion_code'))->create($request->input('payment_method'));
            } else {
                $request->user()->newSubscription('default', $request->input('price'))->create($request->input('payment_method'));
            }
        } catch (IncompletePayment $exception) {
            return redirect(route('cashier.payment', [$exception->payment->id, 'redirect' => route('seller.dashboard')]));
        }
        return redirect(route('seller.dashboard'));
    }

    public function swap(Request $request, $id)
    {
        if (!$request->user()->subscribedToProduct(Price::products(), 'default')) {
            return redirect(route('seller.plans.index'));
        }
        $request->user()->subscription('default')->swap($id);
        return redirect()->back();
    }

    public function cancel(Request $request)
    {
        if (!$request->user()->subscribedToProduct(Price::products(), 'default')) {
            return redirect(route('seller.plans.index'));
        }
        $request->user()->subscription('default')->cancel();
        return redirect()->back();
    }

    public function resume(Request $request)
    {
        if (!$request->user()->subscribedToProduct(Price::products(), 'default')) {
            return redirect(route('seller.plans.index'));
        }
        $request->user()->subscription('default')->resume();
        return redirect()->back();
    }
}
