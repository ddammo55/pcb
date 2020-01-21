<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'serial_start_no' => 'required|regex:/[0-9]{2}[a-lA-L]{1}[[0-9]{4}/',
            'serial_end_no' => 'required|min:4|regex:/[0-9]{2}[a-lA-L]{1}[[0-9]{4}/',
            'quantity' => 'regex:/[1-9]/',
            'board_name' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'serial_start_no.required' => '시작 번호는 필수 입력 항목입니다.',
            'serial_end_no.required' => '끝 번호는 필수 입력 항목입니다.',
            'min' => ':attribute 은 최소 :min 글자 이상이 필요함.',
            'regex' => ':attribute 은 시리얼번호 형식에 맞지 않습니다. ex)19A0001',
            'board_name.required' => '보드명을 선택해 주세요.'
        ];
    }
}
