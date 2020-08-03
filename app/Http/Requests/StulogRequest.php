<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'log_date' => [
                'required',
                Rule::unique('stulogs')->ignore($this->input('id'))->where(function($query) {
                    $query->where('user_id', $this->input('user_id'));
                }),
            ],
            'time' => 'required',
            'user_id' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'log_date.required' => '日付を入力してください。',
            'time.required' => '勉強時間を入力してください。',
        ];
    }
    
    //$requestにuser_idをいれ、バリデーションが有効となるようにする。
    protected function prepareForValidation()
    {
        $this->merge(array( 'user_id' => $this->user()->id ));
    }
}