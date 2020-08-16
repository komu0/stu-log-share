<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    public function store(CategoryRequest $request)
    {
        $user = \Auth::user();
        $user->categories()->create([
            'name' => $request->name,
        ]);
        return redirect('setting/tags')->with('flash_message', 'カテゴリを追加しました。');
    }
}
