<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PbaRequest extends FormRequest
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
        if(request('board_name')){
            return [
                'board_name' => 'required',
                'project_name' => 'required',        
                'content' => 'required',    
            ];
        }else{

            return [
                'assy_name' => 'required',        
                'project_name' => 'required',
                'content' => 'required',    
            ];
        }
    }

    public function messages()
    {
        return [
            'board_name.required' => '보드명은 필수 입력 항목입니다.',
            'project_name.required' => '프로젝트명은 필수 입력 항목입니다.',
            'assy_name.required' => 'assy명은 필수 입력 항목입니다.',
            'content.required' => '본문은 필수 입력 항목입니다.',
        ];
    }
}
