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
            'study_time' => 'required',
            'user_id' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'log_date.unique' => 'この日付のスタログは既に投稿済みです。'
        ];
    }
    
    protected function prepareForValidation()
    {
        //$requestにuser_idをいれ、バリデーションが有効となるようにする。
        $this->merge(array( 'user_id' => $this->user()->id ));
        //$requestにidをいれ、upadteの際自身のレコードを無視するようにする。
        //rules() の ignore($this->input('id')) の部分。
        $this->merge(array( 'id' => $this->stulog ));
    }
}
