<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Category;
use App\Http\Requests\TagRequest;
use App\Http\Requests\TagOrderRequest;

class TagsController extends Controller
{
    public function store(TagRequest $request, $id)
    {
        $category = Category::find($id);
        $category->tags()->create([
            'name' => $request->name,
        ]);
        return redirect('setting/tags')->with('flash_message', 'タグを追加しました。');
    }
    
    public function updateOrder(TagOrderRequest $request)
    {   
        foreach ($request->order as $id => $order) {
            Tag::find($id)->update([
                'order' => $order,
            ]);
        }
        return redirect('setting/tags')->with('flash_message', '優先順位を変更しました。');
    }
}
