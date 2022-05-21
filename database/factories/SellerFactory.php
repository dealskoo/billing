<?php

namespace Database\Factories\Dealskoo\Billing\Models;

use Dealskoo\Billing\Models\Seller;
use Database\Factories\Dealskoo\Seller\Models\SellerFactory as Factory;

class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seller::class;
}
