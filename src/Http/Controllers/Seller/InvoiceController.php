<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class InvoiceController extends SellerController
{
    public function index(Request $request)
    {
        $paymentIntent = Cashier::stripe()->paymentIntents->create(['amount' => 1400, 'currency' => 'usd', 'automatic_payment_methods' => ['enabled' => true]]);
        return view('billing::seller.invoice.index', ['clientSecret' => $paymentIntent->client_secret]);
    }
}
