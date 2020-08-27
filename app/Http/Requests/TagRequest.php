<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\User;
use App\Tag;

class TagRequest extends FormRequest
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
        $unique = function($attribute, $value, $fail) {
            if(Tag::findOrFail($this->id)->name != $value) {
                if(User::find($this->user_id)->tags()->where('tags.name', $value)->exists()){
                    $fail('そのタグ名は既に存在します。');
                }
            }
        };
        
        return [
            'name' => [
                'required',
                'max:10',
                $unique,
            ],
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'タグ名を入力してください。',
            'name.max' => 'タグ名は10字以下で入力してください。',
        ];
    }
    
    protected function prepareForValidation()
    {
        //$requestにuser_idをいれ、バリデーションが有効となるようにする。
        $this->merge(array( 'user_id' => $this->user()->id ));
        
        //$requestにidをいれ、upadteの際自身のレコードを無視するようにする。
        $this->merge(array( 'id' => $this->id ));
    }
}
