<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AnalyzeController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        
        // これは良いけど他もまとめて出したいので却下
        // $wholeStudyTime = 0;
        // foreach($user->stulogs as $stulog){
        //     $date = date('m月d日',strtotime($stulog->log_date));
        //     $wholeStudyTime += $stulog->study_time();
        //     $wholeStudyTimeArray[] = ['date'=>$date, 'time'=>$wholeStudyTime];
        // }
        
        // こうするとカテゴリーが出すのが難しいのでボツ
        // foreach($user->categories as $category) {
        //     $categoryTime = 0;
        //     $categoryStudyTimeArray = [];
        //     foreach($category->tags as $tag) {
        //         $time = 0;
        //         $tagStudyTimeArray = [];
        //         foreach($tag->stulog_contents as $content){
        //             $date = date('m月d日',strtotime($content->stulog->log_date));
        //             $time += $content->study_time;
        //             $tagStudyTimeArray[$date] = $time;
        //         }
        //         $wholeTagStudyTimeArray[$tag->name] = [$tagStudyTimeArray];
        //     }
        //     $wholeCategoryStudyTimeArray[$category->name] = [$categoryStudyTimeArray];
        // }
        
        //$stulogで回すのは確定(log_dateを通して1回だけ回す)
        //計算に使う$timeと
        //表示に使う$timeTransArrayを定義
        $time['総勉強時間'] = 0; 
        $timeTransArray['総勉強時間'] = [];
        foreach ($user->tags as $tag) {
            $time[$tag->name] = 0;
            $timeTransArray[$tag->name] = [];
        }
        foreach ($user->categories as $category) {
            $time[$category->name] = 0;
            $timeTransArray[$category->name] = [];
        }
        
        foreach($user->stulogs as $stulog){
            $log_date = date('m月d日',strtotime($stulog->log_date));
            foreach($stulog->contents as $content) {
                $study_time = $content->study_time;
                $tag_name = $content->tag->name;
                $category_name = $content->tag->category->name;
                $time['総勉強時間'] += $study_time;
                $time[$tag_name] += $study_time;
                $time[$category_name] += $study_time;
            }
            //ここまででそれぞれに入れる時間が確定している。
            //とりあえずすべての区分にデータを入れる。
            $timeTransArray['総勉強時間'][$log_date] = $time['総勉強時間'];
            foreach ($user->tags as $tag) {
                $timeTransArray[$tag->name][$log_date] = $time[$tag->name];
            }
            foreach ($user->categories as $category) {
                $timeTransArray[$category->name][$log_date] = $time[$category->name];
            }
        }
        
        return view('analyze.index', [
            'user' => $user,
            'timeTransArray' => $timeTransArray,
        ]);
    }
}
    
