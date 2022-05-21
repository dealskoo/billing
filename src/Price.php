<?php

namespace Dealskoo\Billing;

use Illuminate\Support\Arr;
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

    public function interval($stripe_id)
    {
        $price = $this->price($stripe_id);
        return $price->recurring->interval;
    }

    public function plan($stripe_id)
    {
        $plans = config('billing.plans');
        foreach ($plans as $plan) {
            foreach ($plan as $p) {
                if ($p['stripe_id'] == $stripe_id) {
                    return $p;
                }
            }
        }
    }

    public function products()
    {
        if (Cache::has('stripe_product_ids')) {
            return Cache::get('stripe_product_ids');
        } else {
            $products = Cashier::stripe()->products->all();
            $stripe_product_ids = Arr::pluck($products->data, 'id');
            Cache::put('stripe_product_ids', $stripe_product_ids);
            return $stripe_product_ids;
        }
    }
}
