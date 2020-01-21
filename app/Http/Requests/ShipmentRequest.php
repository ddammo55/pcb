<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
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
            // 'skills[]' => 'required',
            'project' => 'required',
            'shipment_date' => 'required',
            'receiver' => 'required',
            'note' => 'max:50',
        ];
    }

    public function messages()
    {
        return [
            // 'skills[].required' => '시리얼번호는 필수 선택 항목입니다.',
            'shipment_date.required' => '날짜는 필수 선택 항목입니다.',
            'project.required' => '프로젝트는 필수 입력 항목입니다.',
            'receiver.required' => '인수자는 필수 입력 항목입니다.',
            'note.max' => '글자는 30자리',
        ];
    }
}
