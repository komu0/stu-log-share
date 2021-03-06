<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\BaseClass;
use App\Stulog;
use App\StulogContent;
use App\User;
use App\Http\Requests\StulogRequest;

class StulogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            $allIds = User::pluck('users.id')->toArray();
            $mutingIds = $user->mutings()->pluck('users.id')->toArray();
            $userIds = array_diff($allIds, $mutingIds);
            $stulogs = Stulog::whereIn('user_id', $userIds)->orderBy('log_date', 'desc')->orderBy('updated_at', 'desc')->paginate(10);
            
            $user->loadRelationshipCounts();
            
            return view('stulogs.index', [
                'stulogs' => $stulogs,
                'user' => $user,
            ]);
        } else {
            $stulogs = Stulog::orderBy('log_date', 'desc')->orderBy('updated_at', 'desc')->paginate(10);
            return view('stulogs.index', [
                'stulogs' => $stulogs,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stulog = new Stulog;
        
        $contentsArray = [];
        while(count($contentsArray) < 10){
            $contentsArray[] = [
                "タグ" => '',
                "勉強時間" => '',
                "内容" => '',
            ];
        }

        // メッセージ作成ビューを表示
        return view('stulogs.create', [
            'stulog' => $stulog,
            'contentsArray' => $contentsArray,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StulogRequest $request)
    {
        $user = \Auth::user();
        $stulog = $request->user()->stulogs()->create([
            'log_date' => $request->log_date,
            'thought' => $request->thought,
        ]);
        $messages = '';
        foreach($request->contentsArray as $content){
            //コンテンツのタグが未入力であれば処理しない。
            if($content['タグ'] == NULL) {
                continue;
            }
            //タグが存在しない場合、作成する。
            if($user->tags()->where('tags.name',$content['タグ'])->doesntExist()){
                //未設定カテゴリを作成。
                $category = $user->categories()->firstOrCreate([
                    'name' => '未設定'
                ]);
                $category->tags()->create([
                    'name' => $content['タグ'],
                ]);
                $messages .= 'タグ「' . $content['タグ'] . '」を新規追加しました。' . PHP_EOL;
            }
            //study_contentsテーブルにcreateする。
            $stulog->contents()->create([
                'tag_id' => $user->tags()->where('tags.name',$content['タグ'])->first()->id,
                'study_time' => BaseClass::time_hhmm_to_double($content['勉強時間']),
                'comment' => $content['内容'],
            ]);
        };
          
        $messages .=  'スタログを投稿しました。(過去のスタログは一番上に表示されない場合があります。)';
        return redirect('/')->with('flash_message', $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stulog = Stulog::findOrFail($id);

        if (\Auth::id() != $stulog->user_id) {
            return redirect('/')->with('flash_message', '権限がありません。');
        }
        
        $contents = $stulog->contents;
        $contentsArray = [];
        foreach($contents as $content){
            $contentsArray[] = [
                "タグ" => $content->tag->name,
                "勉強時間" => $content->display_study_time_hhmm(),
                "内容" => $content->comment,
            ];
        }
        while(true){
            $contentsArray[] = [
                "タグ" => '',
                "勉強時間" => '',
                "内容" => '',
                ];
            if (count($contentsArray) >= 10) {
                break;
            }
        }
        
        return view('stulogs.edit', [
            'stulog' => $stulog,
            'contentsArray' => $contentsArray,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StulogRequest $request, $id)
    {
        $stulog = Stulog::findOrFail($id);
        $user = $stulog->user;
        $messages = '';
        //一度現在のスタログコンテンツは削除する。
        $stulog->contents()->delete();
        
        if ( \Auth::id() == $user->id ) {
            //スタログを更新
            $stulog->update([
                'log_date' => $request->log_date,
                'thought' => $request->thought,
            ]);
            //コンテンツを更新
            foreach($request->contentsArray as $content){
                //コンテンツのタグが未入力であれば処理しない。
                if($content['タグ'] == NULL) {
                    continue;
                }
                //タグが存在しない場合、作成する。
                if($user->tags()->where('tags.name',$content['タグ'])->doesntExist()){
                    //未設定カテゴリを作成。
                    $category = $user->categories()->firstOrCreate([
                        'name' => '未設定'
                    ]);
                    $category->tags()->create([
                        'name' => $content['タグ'],
                    ]);
                    $messages .= 'タグ「' . $content['タグ'] . '」を新規追加しました。' . PHP_EOL;
                }
                //study_contentsテーブルにcreateする。
                $stulog->contents()->create([
                    'tag_id' => $user->tags()->where('tags.name',$content['タグ'])->first()->id,
                    'study_time' => BaseClass::time_hhmm_to_double($content['勉強時間']),
                    'comment' => $content['内容'],
                ]);
            };
        }
        $messages .=  'スタログを投稿しました。(過去のスタログは一番上に表示されない場合があります。)';
        return redirect('/')->with('flash_message', $messages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stulog = Stulog::findOrFail($id);
        if ( \Auth::id() == $stulog->user_id ) {
            $stulog->delete();
        }
        return redirect('/')->with('flash_message', 'スタログを削除しました。');
    }
}
