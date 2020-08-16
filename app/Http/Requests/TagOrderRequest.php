<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagOrderRequest extends FormRequest
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
        $rule = function($attribute, $value, $fail) {
            $messages = [];
            $checkRequired = false;
            $checkMaxMin = false;
            foreach ($value as $key => $order) {
                if ($order == null) {
                    $checkRequired = true;
                } elseif ($order >= 10000 || $order <= 0) {
                    $checkMaxMin = true;
                }
            }
            if($checkRequired){
                $messages[] = ("未入力の優先順位があります。");
            }
            if($checkMaxMin){
                $messages[] = ("優先順位は1～9999の数字で指定してください。");
            }
            if(count($messages)) {
                $fail($messages);
            }
        };

        return [
            'order' => [
                $rule,
            ],
        ];
    }
}
