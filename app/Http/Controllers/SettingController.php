<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Category;
use App\Tag;

class SettingController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        return view('setting.index', [
            'user' => $user,
        ]);
    }
    
    public function tags()
    {
        $user = \Auth::user();
        $category = new Category;
        $tag = new Tag;
        return view('setting.tags', [
            'user' => $user,
            'category' => $category,
            'tag' => $tag,
        ]);
    }
}
