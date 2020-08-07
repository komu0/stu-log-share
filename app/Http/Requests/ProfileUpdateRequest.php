<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        
        $lineCountCheck = function($attribute, $value, $fail) {
            if (substr_count($value,"\r\n") >= 10){
                $fail('プロフィールに改行が多すぎます。');
            }
        };
        
        $max300 = function($attribute, $value, $fail) {
            if (mb_strlen(preg_replace("/\r\n/", "", $value)) > 300){
                $fail('プロフィールは300文字以下で入力してください。');
            }
        };
        
        return [
            'profile' =>  [
                $lineCountCheck,
                $max300,
            ],
        ];
    }
}
