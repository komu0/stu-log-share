<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stulog;
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
        //すべてのスタログを取得
        $stulogs = \App\Stulog::orderBy('log_date', 'desc')->orderBy('updated_at', 'desc')->paginate(100);
        
        if (\Auth::check()) {
            $user = \Auth::user();
            $user->loadRelationshipCounts();
            return view('stulogs.index', [
                'stulogs' => $stulogs,
                'user' => $user,
            ]);
        }
        
        return view('stulogs.index', [
            'stulogs' => $stulogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stulog = new Stulog;

        // メッセージ作成ビューを表示
        return view('stulogs.create', [
            'stulog' => $stulog,
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
        $study_time_H=substr($request->time, 0, 2);
        $study_time_H=(int)$study_time_H;
        $study_time_M=substr($request->time, 3, 2);
        $study_time_M=(int)$study_time_M;
        
        $user = \Auth::user();
        $request->user()->stulogs()->create([
            'log_date' => $request->log_date,
            'study_time_H' => $study_time_H,
            'study_time_M' => $study_time_M,
            'content' => $request->content,
            'thought' => $request->thought,
        ]);
        return redirect('/');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
