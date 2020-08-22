@extends('layouts.app')

@section('content')
<div class="p-5 mb-4 offset-lg-2 col-lg-8 offset-sm-1 col-sm-10 border rounded">
<h1 class="mb-4 mb-5">スタログシェアとは</h1>
<div class="mb-5">
    <div class="border-bottom border-top mb-3 pb-3 pt-3">
        <h2>スタログシェアって何？</h2>
        スタログシェアは、自分の勉強時間や勉強内容などを記録したもの(=<span class="font-weight-bold">スタログ</span>)を
        投稿・共有することが可能なコミュニティウェブサイトです。
    </div>
    <div class="border-bottom mb-3 pb-3">
        <h2>具体的には何ができるの？</h2>
        毎日のスタログの投稿・削除・編集の他、ユーザのフォローや総勉強時間の計算など、様々な機能がご利用可能です。
    </div>
</div>
@if (Auth::check())
    <div class="text-center">
        {!! link_to_route('home', 'ホームへ戻る', [], ['class' => 'pt-1 pb-1 offset-4 col-4 btn-lg btn btn-block btn-primary']) !!}
    </div>
@else
    <div class="text-center">
        <p class="h1">さあ、今すぐスタログシェアを始めましょう！</p>
        {!! link_to_route('signup.get', '新規登録(無料)', [], ['class' => 'pt-1 pb-1 offset-4 col-4 btn-lg btn btn-block btn-primary']) !!}
        {!! link_to_route('login', 'ログイン', [], ['class' => 'pt-1 pb-1 offset-4 col-4 btn-lg btn btn-block btn-light']) !!}
    </div>
@endif
</div>
@endsection
