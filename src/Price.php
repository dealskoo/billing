<?php

namespace Dealskoo\Billing;

use Illuminate\Support\Facades\Cache;
use Laravel\Cashier\Cashier;

class Price
{

    public function name($stripe_id)
    {
        $product = $this->product($stripe_id);
        return $product->name;
    }

    public function price($stripe_id)
    {
        if (Cache::has($stripe_id)) {
            return Cache::get($stripe_id);
        } else {
            $price = Cashier::stripe()->prices->retrieve($stripe_id);
            Cache::put($stripe_id, $price);
            return $price;
        }
    }

    public function product($stripe_id)
    {
        $price = $this->price($stripe_id);
        if (Cache::has($price->product)) {
            return Cache::get($price->product);
        } else {
            $product = Cashier::stripe()->products->retrieve($price->product);
            Cache::put($price->product, $product);
            return $product;
        }
    }

    public function money($stripe_id)
    {
        $price = $this->price($stripe_id);
        return config('billing.currency_symbol') . ($price->unit_amount / 100);
    }

    public function recommended($stripe_id)
    {
        $product = $this->product($stripe_id);
        return $product->metadata['recommend'] ? true : false;
    }

    public function icon($stripe_id)
    {
        $product = $this->product($stripe_id);
        return $product->metadata['icon'] ?? '';
    }
}
