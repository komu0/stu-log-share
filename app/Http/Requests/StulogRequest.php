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
        $releaseDate = config('app.releaseDate');
        $tomorrow = date('Y-m-d', strtotime('tomorrow'));
        
        $studyTimeZeroCheck = function($attribute, $value, $fail) {
            if ($this->study_time == '00:00' ) {
                if ($value != NULL ) {
                    $fail('勉強時間が00:00のとき、内容は入力できません。');
                }
            }
        };
        
        $lineCountCheck = function($attribute, $value, $fail) {
            if (substr_count($value,"\r\n") >= 10){
                if($attribute == 'content') {
                    $fail('内容に改行が多すぎます。');
                } elseif ($attribute == 'thought') {
                    $fail('感想に改行が多すぎます。');
                } else {
                    $fail('改行が多すぎます。');
                }
                    
            }
        };
        
        $max300 = function($attribute, $value, $fail) {
            if (mb_strlen(preg_replace("/\r\n/", "", $value)) > 300){
                if($attribute == 'content') {
                    $fail('内容は300文字以下で入力してください。');
                } elseif ($attribute == 'thought') {
                    $fail('感想は300文字以下で入力してください。');
                } else {
                    $fail('文字数が多すぎます。');
                }
                    
            }
        };
        
        return [
            'log_date' => [
                'required',
                Rule::unique('stulogs')->ignore($this->input('id'))->where(function($query) {
                    $query->where('user_id', $this->input('user_id'));
                }),
                "after:$releaseDate",
                "before:$tomorrow",
            ],
            'study_time' => 'required',
            'user_id' => 'required',
            'content' => [
                $studyTimeZeroCheck,
                $lineCountCheck,
                $max300,
            ],
            'thought' => [
                $lineCountCheck,
                $max300,
            ],
        ];
    }
    
    public function messages()
    {
        return [
            'log_date.unique' => 'この日付のスタログは既に投稿済みです。',
            'log_date.after' => 'サービス開始以前のスタログは登録できません。',
            'log_date.before' => '未来のスタログは登録できません。',
            'study_time.not_in' => '勉強時間を入力してください。',
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
