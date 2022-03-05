<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckReference implements Rule
{
    protected $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $references = json_decode($value);
        for ($i = 0; $i < count($references); $i++) {
            if (strlen($references[$i]->code) >= 255) {
                $this->message = "Độ dài code hơn 255 ký tự";
                return false;
            }
            if (Carbon::createFromFormat('d/m/Y', $references[$i]->publish_date)->gt(now()->format('d/m/Y'))) {
                $this->message = "Thời gian không vượt quá ngày hiện tại";
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
