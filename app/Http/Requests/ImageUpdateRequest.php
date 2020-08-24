<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
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
        $dimensions = function($attribute, $value, $fail) {
            $messages = [];
            foreach ($value as $key => $content) {
                if (mb_strlen(preg_replace("/\r\n/", "", $content['内容'])) > 100){
                    $messages[] = ('[' . ($key + 1) . '-内容]は100字以下で入力してください。');
                }
            }
            if($messages) {
                $fail($messages);
            }
        };
        
        return [
            'file' => [
                'required',
                'file',
                'image',
                'mimes:jpeg,png',
                $dimensions,
            ]
        ];
    }
    
    public function messages()
    {
        return [
            'file.required' => '画像が選択されていません。',
        ];
    }
}
