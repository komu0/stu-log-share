<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
