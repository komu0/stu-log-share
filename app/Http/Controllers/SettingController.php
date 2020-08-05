<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class SettingController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        return view('setting.index', [
            'user' => $user,
        ]);
    }
}
