<?php

namespace Dealskoo\Billing\Models;

use Dealskoo\Billing\Facades\Price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dealskoo\Seller\Models\Seller as BaseSeller;
use Illuminate\Support\Str;
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

    public function interval()
    {
        $subscription = $this->subscription('default');
        if ($subscription) {
            return Str::upper(Price::interval($subscription->stripe_price));
        }
        return Str::upper('month');
    }

    public function plan()
    {
        $subscription = $this->subscription('default');
        if ($subscription) {
            $product = Price::product($subscription->stripe_price);
            return $product;
        }
        return null;
    }

    public function plan_name()
    {
        $plan = $this->plan();
        if ($plan) {
            return Str::upper($plan->name);
        }
        return null;
    }

    public function has_plan($plan)
    {
        switch (Str::upper($plan)) {
            case Str::upper('lite'):
                return $this->has_lite_plan();
            case Str::upper('standard'):
                return $this->has_standard_plan();
            case Str::upper('advanced'):
                return $this->has_advanced_plan();
            default:
                return false;
        }
    }

    public function has_lite_plan()
    {
        $plan = $this->plan_name();
        if (($plan && $plan == Str::upper('lite')) || $this->has_standard_plan() || $this->has_advanced_plan()) {
            return true;
        }
        return false;
    }

    public function has_standard_plan()
    {
        $plan = $this->plan_name();
        if (($plan && $plan == Str::upper('standard')) || $this->has_advanced_plan()) {
            return true;
        }
        return false;
    }

    public function has_advanced_plan()
    {
        $plan = $this->plan_name();
        if ($plan && $plan == Str::upper('advanced')) {
            return true;
        }
        return false;
    }
}
