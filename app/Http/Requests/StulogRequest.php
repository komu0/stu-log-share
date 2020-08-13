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
        
        $inputCheck = function($attribute, $value, $fail) {
            $messages = [];
            foreach ($value as $key => $content) {
                if ($content['タグ'] == NULL ) {
                    if ($content['勉強時間'] == '00:00' || $content['勉強時間'] == NULL) {
                        if ($content['内容'] != NULL) {
                            $messages[] = ('[' . ($key + 1) . '-タグ][' . ($key + 1) . '-勉強時間]が入力されていません。');
                        }
                    } else {
                        $messages[] = ('[' . ($key + 1) . '-タグ]が入力されていません。');
                    }
                } else {
                    if ($content['勉強時間'] == '00:00' || $content['勉強時間'] == NULL) {
                        $messages[] = ('[' . ($key + 1) . '-勉強時間]が入力されていません。');
                    }
                }
            }
            if($messages){
                $fail($messages);
            }
        };
        
        $lineCountCheck = function($attribute, $value, $fail) {
            if (substr_count($value,"\r\n") >= 10){
                if ($attribute == 'thought') {
                    $fail('感想に改行が多すぎます。');
                } else {
                    $fail('改行が多すぎます。');
                }
            }
        };
        
        $max300 = function($attribute, $value, $fail) {
            if (mb_strlen(preg_replace("/\r\n/", "", $value)) > 300){
                if ($attribute == 'thought') {
                    $fail('感想は300文字以下で入力してください。');
                } else {
                    $fail('文字数が多すぎます。');
                }
            }
        };
        
        $max100 = function($attribute, $value, $fail) {
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
        
        $uniqueTag = function($attribute, $value, $fail) {
            $messages = [];
            $array = [];
            foreach ($value as $content) {
                if($content['タグ']) {
                    $array[] = $content['タグ'];
                }
            }
            if (max(array_count_values($array)) != 1) {
                $fail("同じタグを2つ以上登録することはできません。");
            };
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
            'user_id' => 'required',
            'thought' => [
                $lineCountCheck,
                $max300,
            ],
            'contentsArray' => [
                $inputCheck,
                $max100,
                $uniqueTag,
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
        //dd($this->contentsArray);
        //$requestにuser_idをいれ、バリデーションが有効となるようにする。
        $this->merge(array( 'user_id' => $this->user()->id ));
        
        //$requestにidをいれ、upadteの際自身のレコードを無視するようにする。
        //rules() の ignore($this->input('id')) の部分。
        $this->merge(array( 'id' => $this->stulog ));
    }
}
