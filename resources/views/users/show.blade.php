@extends('layouts.app')

@section('content')
    <h2>プロフィール</h2>
    <p>ID:{{ $user->id }}</p>
    <p>開始日:{{ $user->created_at->format('Y年m月d日') }}</p>
    <p>総勉強時間:{{ $user->studyTime() }}</p>
    <p>{{ $user->profile }}</p>
    <p>フォロー:{!! link_to_route('users.followings', $user->followings_count , ['id' => $user->id]) !!}</p>
    <p>フォロワー:{!! link_to_route('users.followers', $user->followers_count , ['id' => $user->id]) !!}</p>
    <h2>ログ</h2>
    @include('stulogs.stulogs')
@endsection