<?php

namespace Dealskoo\Billing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dealskoo\Seller\Models\Seller as BaseSeller;
use Laravel\Cashier\Billable;

class Seller extends BaseSeller
{
    use HasFactory, Billable;
}
