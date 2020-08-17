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
        foreach ($request->order as $id => $order) {
            Category::find($id)->update([
                'order' => $order,
            ]);
        }
        return redirect('setting/tags')->with('flash_message', '優先順位を変更しました。');
    }
    
    public function updateName(CategoryRequest $request, $id)
    {
        Category::find($id)->update([
            'name' => $request->name,
        ]);
        return redirect('setting/tags')->with('flash_message', 'カテゴリ名を編集しました。');
    }
    
    public function destroy($id)
    {
        $category = Category::find($id);
        
        if($category->tags()->exists()) {
            return redirect('setting/tags')->with('flash_error_message', '既にスタログが投稿されているため削除できません。');
        }
        if ( \Auth::id() == $category->user->id ) {
            $category->delete();
        }
        return redirect('setting/tags')->with('flash_message', 'カテゴリを削除しました。');
    }
}
