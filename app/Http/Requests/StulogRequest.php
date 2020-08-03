<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StulogRequest extends FormRequest
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
            'log_date' => 'required',
            'time' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'log_date.required' => '日付を入力してください。',
            'time.required' => '勉強時間を入力してください。',
        ];
    }
}
