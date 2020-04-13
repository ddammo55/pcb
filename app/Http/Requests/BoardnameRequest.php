<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardnameRequest extends FormRequest
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
            'boardname' => 'required|unique:boardnames',
            // 'top_num' => 'required|max:3',
            // 'bot_num' => 'required|max:3',
            // 'method' => 'required',
            // 'note' => 'max:50',
        ];
    }

    public function messages()
    {
        return [
            'boardname.required' => '보드명은 필수 입력 항목입니다.',
            'boardname.unique' => '이미 같은 이름의 보드명이 있습니다. 다른 이름으로 작성해 주세요.',
            // 'top_num.required' => 'TOP 부품 수량 필수 입력 항목입니다.',
            // 'top_num.max' => 'TOP 부품 수량 4자리',
            // 'bot_num.max' => 'BOT 부품 수량 4자리',
            // 'bot_num.required' => 'BOT 부품 수량 필수 입력 항목입니다.',
            // 'method.required' => '작업방법은 필수 입력 항목입니다.',
            // 'note.max' => '글자는 30자리',
        ];
    }
}
