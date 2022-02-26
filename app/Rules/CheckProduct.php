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
//            if ($products[$i]->specification === "" || strlen($products[$i]->specification) >= 255) {
//                $this->message = 'Đặc tính kỹ thuật của sản phẩm đang nhập sai';
//                return false;
//            }
//            if ($products[$i]->symbol === "" || strlen($products[$i]->symbol) >= 255) {
//                $this->message = 'Ký hiệu của sản phẩm đang nhập sai';
//                return false;
//            }
//            if ($products[$i]->origin === "" || strlen($products[$i]->origin) >= 255) {
//                $this->message = 'Xuất xứ, nhà sản xuất của sản phẩm đang nhập sai';
//                return false;
//            }
//            if ($products[$i]->amount === "" || !is_int($products[$i]->amount)) {
//                $this->message = 'Số lượng của sản phẩm đang nhập sai';
//                return false;
//            }

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
