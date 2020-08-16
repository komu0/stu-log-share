<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryOrderRequest;

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
    
    public function updateOrder(CategoryOrderRequest $request)
    {   
        $user = \Auth::user();
        foreach ($request->order as $id => $order) {
            Category::find($id)->update([
                'order' => $order,
            ]);
        }
        return redirect('setting/tags')->with('flash_message', '優先順位を変更しました。');
    }
}
