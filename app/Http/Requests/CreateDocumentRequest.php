<?php

namespace App\Http\Requests;

use App\Rules\CheckProduct;
use App\Rules\CheckReference;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentRequest extends FormRequest
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
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255|email',
            'import_gate' => 'required|max:255',
            'import_date' => 'required|max:255|date_format:d/m/Y|before:tomorrow',
            'attach_file' => 'nullable|mimes:pdf,doc,docx|max:5000',
            'reference' => [ new CheckReference() ],
            'product' => new CheckProduct(),
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Mời bạn nhập dữ liệu',
            'max' => 'Dữ liệu không được vượt quá 255 ký tự',
            'import_date.date_format' => 'Thời gian nhập hàng không đúng định dạng',
            'import_date.before' => 'Thời gian nhập hàng không được là ngày tương lai',
            'attach_file.mimes' => 'File đính kèm chỉ chấp nhận định dạng : pdf, docx',
            'attach_file.max' => 'File đính kèm không vượt quá 5MB',
            'email.email' => 'Sai định dạng email',
        ];
    }
}
