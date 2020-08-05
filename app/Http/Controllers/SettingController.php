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
    
    public function profileUpdate(Request $request)
    {
        \Auth::user()->update([
            'profile' => $request->profile,
        ]);
        return back();
    }
}
