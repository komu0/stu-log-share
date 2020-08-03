<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            $user->loadRelationshipCounts();
            $stulogs = $user->feed_stulogs()->orderBy('log_date', 'desc')->orderBy('updated_at', 'desc')->paginate(10);
        }
        
        return view('timeline.index', [
            'stulogs' => $stulogs,
            'user' => $user,
        ]);
        
        
        // if (\Auth::check()) { // 認証済みの場合
        //     // 認証済みユーザを取得
        //     $user = \Auth::user();
        //     // ユーザの投稿の一覧を作成日時の降順で取得
        //     $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        //     $data = [
        //         'user' => $user,
        //         'microposts' => $microposts,
        //     ];
        //}
    }
}
