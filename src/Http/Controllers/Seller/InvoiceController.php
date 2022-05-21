<?php

namespace Dealskoo\Billing\Http\Controllers\Seller;

use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;

class InvoiceController extends SellerController
{
    public function index(Request $request)
    {
        return view('billing::seller.invoice.index');
    }
}