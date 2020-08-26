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
        return redirect('settings/tags')->with('flash_message', 'タグ「'. $request->name .'」を追加しました。');
    }
    
    public function updateOrder(TagOrderRequest $request)
    {   
        foreach ($request->order as $id => $order) {
            Tag::find($id)->update([
                'order' => $order,
            ]);
        }
        return redirect('settings/tags')->with('flash_message', '優先順位を変更しました。');
    }
    
    public function updateName(TagRequest $request, $id)
    {
        $old_name = Tag::find($id)->name;
        $new_name = $request->name;
        Tag::find($id)->update([
            'name' => $request->name,
        ]);
        return redirect('settings/tags')->with('flash_message', 'タグ名を編集しました。(「'.$old_name.'」→「'.$new_name.'」)');
    }
    
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag_name = $tag->name;
        
        if($tag->stulog_contents()->exists()) {
            return redirect('settings/tags')->with('flash_error_message', '既にスタログが投稿されているため削除できません。');
        }
        if ( \Auth::id() == $tag->user->id ) {
            $tag->delete();
        }
        return redirect('settings/tags')->with('flash_message', 'タグ「'. $tag_name .'」を削除しました。');
    }
    
    public function updateCategory(Request $request, $id)
    {
        $user = \Auth::user();
        $tag_name = Tag::find($id)->name;
        $new_category = $request->category_name;
        $old_category = Category::find(Tag::find($id)->category_id)->name;
        $category_id = $user->categories()->where('name',$request->category_name)->first()->id;
        Tag::find($id)->update([
            'category_id' => $category_id,
        ]);
        return redirect('settings/tags')->with('flash_message', 'タグ「'.$tag_name.'」を移動しました。(「'.$old_category.'」→「'.$new_category.'」)');
    }
}
