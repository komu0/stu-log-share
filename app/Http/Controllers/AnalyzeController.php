<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AnalyzeController extends Controller
{
    //timeTransArrayについて
    //総勉強時間
    public function index($id)
    {
        $user = User::findOrFail($id);
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
    
