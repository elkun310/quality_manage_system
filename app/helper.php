<?php

use App\Enums\Classroom;
use App\Enums\Schedule;
use Carbon\Carbon;
use Japanese\Holiday\Repository as HolidayRepository;

if (!function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Mayo01');
    }
}

if (!function_exists('generateCode')) {

    /**
     * Generate code for register user
     */
    function generateCode(string $model)
    {
        $uuid = mt_rand(100000, 999999);
        while ($model::where('code', $uuid)->first()) {
            $uuid = mt_rand(100000, 999999);
        }
        return $uuid;
    }
}

if (!function_exists('checkCompetitionDay')) {

    /**
     * Generate code for register user
     */
    function checkCompetitionDay($date): bool
    {
        $holidayRepository = new HolidayRepository();
        return $holidayRepository->isHoliday($date) || date('N', strtotime($date)) > WEEKEND;
    }
}

if (!function_exists('escapeSpecialCharacter')) {
    /**
     * Function to escape special character in sql like(%)
     *
     * SQLの特殊文字をエスケープする関数like（％）
     * @param $string
     * @return string|string[]
     */
    function escapeSpecialCharacter($string)
    {
        $search = array('%', '_');
        $replace = array('\%', '\_');
        return str_replace($search, $replace, $string);
    }
}

if (!function_exists('checkValidateProduct')) {
    /**
     *
     * SQLの特殊文字をエスケープする関数like（％）
     * @param $value
     * @return bool|string
     */
    function checkValidateProduct($value)
    {
        if ($value->name === "" || strlen($value->name) >= 255) {
            return 'Tên của sản phẩm đang nhập sai';
        }
        if ($value->specification === "" || strlen($value->specification) >= 255) {
            return 'Đặc tính kỹ thuật của sản phẩm đang nhập sai';
        }
        if ($value->symbol === "" || strlen($value->symbol) >= 255) {
            return 'Ký hiệu của sản phẩm đang nhập sai';
        }
        if ($value->origin === "" || strlen($value->origin) >= 255) {
            return 'Xuất xứ, nhà sản xuất của sản phẩm đang nhập sai';
        }
        if ($value->amount === "") {
            return 'Số lượng của sản phẩm đang nhập sai';
        }
        return true;
    }
}