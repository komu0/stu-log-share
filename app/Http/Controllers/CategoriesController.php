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
        return redirect('setting/tags')->with('flash_message', 'カテゴリ「'. $request->name .'」を追加しました。');
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
        $old_name = Category::find($id)->name;
        $new_name = $request->name;
        Category::find($id)->update([
            'name' => $request->name,
        ]);
        return redirect('setting/tags')->with('flash_message', 'カテゴリ名を編集しました。(「'.$old_name.'」→「'.$new_name.'」)');
    }
    
    public function destroy($id)
    {
        $category = Category::find($id);
        $category_name = $category->name;
        
        if($category->stulog_contents()->exists()) {
            return redirect('setting/tags')->with('flash_error_message', '既にスタログが投稿されているため削除できません。');
        }
        if ( \Auth::id() == $category->user->id ) {
            $category->delete();
        }
        return redirect('setting/tags')->with('flash_message', 'カテゴリ「'. $category_name .'」を削除しました。');
    }
}
