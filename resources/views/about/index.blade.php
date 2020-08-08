@extends('layouts.app')

@section('content')
<h1 class="mb-5">スタログシェアとは</h1>
<div class="mb-5">
    <h2>スタログシェアって何？</h2>
    <p>スタログシェアは、自分の勉強時間や勉強内容などを記録したもの(=<span class="font-weight-bold">スタログ</span>)を投稿・共有することが可能なコミュニティウェブサイトです。</p>
    <h2>具体的には何ができるの？</h2>
    <p>毎日のスタログの投稿・削除・編集の他、ユーザのフォローや総勉強時間の計算など、様々な機能がご利用可能です。</p>
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
@endsection
