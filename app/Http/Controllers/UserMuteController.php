<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserMuteController extends Controller
{
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをミュートする
        \Auth::user()->mute($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザをアンミュートする
        \Auth::user()->unmute($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
