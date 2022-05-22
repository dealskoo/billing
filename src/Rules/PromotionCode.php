<?php

namespace Dealskoo\Billing\Rules;

use Dealskoo\Billing\Models\Seller;
use Illuminate\Contracts\Validation\Rule;

class PromotionCode implements Rule
{
    private $seller;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Seller $seller)
    {
        $this->seller = $seller;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $promotionCode = $this->seller->findActivePromotionCode($value);
        return $promotionCode ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The :attribute must is active promotion code.');
    }
}
