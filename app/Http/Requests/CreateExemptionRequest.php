<?php

namespace App\Http\Requests;

use App\Rules\CheckProductExemption;
use Illuminate\Foundation\Http\FormRequest;

class CreateExemptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_company' => 'required|max:255',
            'expired' => 'required|max:255|date_format:d/m/Y',
            'dispatch_number' => 'required|max:255',
            'dispatch_date' => 'required|date_format:d/m/Y',
            'dispatch_file' => 'nullable|mimes:pdf,doc,docx|max:5000',
            'product' => new CheckProductExemption(),
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Mời bạn nhập dữ liệu',
            'max' => 'Dữ liệu không được vượt quá 255 ký tự',
            'date_format' => 'Thời gian nhập hàng không đúng định dạng',
            'before' => 'Thời gian không được là ngày tương lai',
            'dispatch_file.mimes' => 'File đính kèm chỉ chấp nhận định dạng : pdf, docx',
            'dispatch_file.max' => 'File đính kèm không vượt quá 5MB',
        ];
    }
}
