<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($name)
    {
        // nameの値でユーザを検索して取得
        $user = User::where('name', '=', $name)->firstOrFail();

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }
}
