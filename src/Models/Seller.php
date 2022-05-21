<?php

namespace Dealskoo\Billing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dealskoo\Seller\Models\Seller as BaseSeller;
use Laravel\Cashier\Billable;
use function Illuminate\Events\queueable;

class Seller extends BaseSeller
{
    use HasFactory, Billable;

    protected static function booted()
    {
        static::updated(queueable(function ($customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }
}
