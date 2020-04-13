<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
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
            'project_name' => 'required|unique:projects',
            // 'project_code' => 'required|unique:projects',
            // 'car' => 'required',
            // 'kinds' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'project_name.required' => '프로젝트 명은 필수 입력 항목입니다.',
            'project_name.unique' => '이미 같은 이름의 프로젝트 명이 있습니다. 다른 이름으로 작성해주세요',
            // 'project_code.required' => '프로젝트 코드는 필수 입력 항목입니다.',
            // 'project_code.unique' => '이미 같은 이름의 프로젝트 코드명이 있습니다. 다른 이름으로 작성해주세요',
            // 'car.required' => '량은 필수 입력 항목입니다.',
            // 'kinds.required' => '종류는 필수 입력 항목입니다.',
        ];
    }
}
