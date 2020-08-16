<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->input('id'))->where(function($query) {
                    $query->where('user_id', $this->input('user_id'));
                }),
                'max:15',
            ],
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'カテゴリ名を入力してください。',
            'name.max' => 'カテゴリ名は15文字以下で入力してください。',
            'name.unique' => 'そのカテゴリ名は既に存在します。',
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
