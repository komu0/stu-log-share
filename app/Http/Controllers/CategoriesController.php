<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    
    public function store(Request $request)
    {
        dd($request);
        $user = \Auth::user();
        $stulog = $request->user()->stulogs()->create([
            'log_date' => $request->log_date,
            'thought' => $request->thought,
        ]);
        $messages = '';
        foreach($request->contentsArray as $content){
            //コンテンツのタグが未入力であれば処理しない。
            if($content['タグ'] == NULL) {
                continue;
            }
            //タグが存在しない場合、作成する。
            if($user->tags()->where('tags.name',$content['タグ'])->doesntExist()){
                //未設定カテゴリを作成。
                $category = $user->categories()->firstOrCreate([
                    'name' => '未設定'
                ]);
                $category->tags()->create([
                    'name' => $content['タグ'],
                ]);
                $messages .= 'タグ「' . $content['タグ'] . '」を新規追加しました。' . PHP_EOL;
            }
            //study_contentsテーブルにcreateする。
            $stulog->contents()->create([
                'tag_id' => $user->tags()->where('tags.name',$content['タグ'])->first()->id,
                'study_time' => BaseClass::time_hhmm_to_double($content['勉強時間']),
                'comment' => $content['内容'],
            ]);
        };
          
        $messages .=  'スタログを投稿しました。(過去のスタログは一番上に表示されない場合があります。)';
        return redirect('/')->with('flash_message', $messages);
    }
}
