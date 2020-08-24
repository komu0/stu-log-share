<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InterventionImage;
use App\User;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ImageUpdateRequest;

class UsersController extends Controller
{
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        //このユーザのスタログを取得
        $stulogs = $user->stulogs()->orderBy('log_date', 'desc')->orderBy('updated_at', 'desc')->paginate(10);
        
        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'stulogs' => $stulogs,
        ]);
    }
    
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->orderBy('pivot_created_at', 'desc')->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->orderBy('pivot_created_at', 'desc')->paginate(10);
        
        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    public function mutings()
    {
        $user = \Auth::user();
        $mutings = $user->mutings()->orderBy('pivot_created_at', 'desc')->paginate(10);

        return view('users.mutings', [
            'user' => $user,
            'users' => $mutings,
        ]);
    }
    
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        \Auth::user()->update([
            'profile' => $request->profile,
        ]);
        return back()->with('flash_message', 'プロフィールを変更しました。');
    }
    
    public function passwordUpdate(PasswordUpdateRequest $request)
    {
        \Auth::user()->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('flash_message', 'パスワードを変更しました。');
    }
    
    public function imageUpdate(ImageUpdateRequest $request)
    {
        $file = $request->file;
        $extension = '.' . substr($file->getClientMimeType(),6);
        $user = User::find(auth()->id());
        $name = 'profile_image' . date('YmdHis') . $extension;
        $path = public_path('storage/avatar/' . $user->id);
        if(!\File::exists($path)) {
            \File::makeDirectory($path);
        }
        InterventionImage::make($file)->resize(350, 350)->save($path . '/' . $name);
        $user->image_path = $user->id . '/' . $name;
        $user->save();
        
        return back()->with('flash_message', 'プロフィール画像を更新しました。');
    }
}
