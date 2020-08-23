@extends('layouts.app')

@section('content')
    <h2 class="mb-4">
        {{$user->id}}さんのユーザページ
        {!! link_to_route('analyze', '分析', ['id' => $user->id], ['class' => 'h-auto btn btn-sm btn-success']) !!}
    </h2>
    <div>
        <div class="d-block d-sm-inline">
            ID:{{ $user->id }} / 開始日:{{ $user->created_at->format('Y年m月d日') }} / 
        </div>
        <div class="d-block d-sm-inline">
            総勉強時間:{{ $user->display_study_time() }}
        </div>
    </div>
    <div class="d-sm-inline">
        <span>フォロー:{!! link_to_route('users.followings', $user->followings_count , ['id' => $user->id]) !!} / </span>
        <span>フォロワー:{!! link_to_route('users.followers', $user->followers_count , ['id' => $user->id]) !!}</span>
    </div>
    <p class="font-weight-bold mb-4 mt-4">{!! nl2br(e($user->profile)) !!}</p>
    <div class = "ml-3 mb-4 row">
        @include('user_follow.follow_button')
        @include('user_mute.mute_button')
    </div>
    @include('stulogs.stulogs')
@endsection