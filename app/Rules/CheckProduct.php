<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckProduct implements Rule
{
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $products = json_decode($value);
        for ($i = 0; $i < count($products); $i ++) {
            $checkProduct = checkValidateProduct($products[$i]);
            if ($checkProduct !== true) {
                $this->message = $checkProduct;
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
