@extends('layouts.app')

@section('content')
    <h2 class="mb-4">
        {{$user->id}}さんのユーザページ
        {!! link_to_route('analyze', '分析', ['id' => $user->id], ['class' => 'h-auto btn btn-sm btn-success']) !!}
    </h2>
    <div class="row mb-3">
        <div class="col-md-2 col-sm-4 offset-sm-0 offset-3 col-6">
            <img class="img-fluid" src="{{ Storage::disk('s3')->url($user->image_path) }}" alt="avatar_image" />
        </div>
        <div class="col-md-10 col-sm-8">
            <div>
                <div class="d-block d-md-inline">
                    ID:{{ $user->id }} / 
                </div>
                <div class="d-block d-md-inline">
                    開始日:{{ $user->created_at->format('Y年m月d日') }} / 
                </div>
                <div class="d-block d-sm-inline">
                    総勉強時間:{{ $user->display_study_time() }}
                </div>
            </div>
            <div>
                <div class="d-block d-sm-inline">
                    フォロー:{!! link_to_route('users.followings', $user->followings_count , ['id' => $user->id]) !!} / 
                </div>
                <div class="d-block d-sm-inline">
                    フォロワー:{!! link_to_route('users.followers', $user->followers_count , ['id' => $user->id]) !!}
                </div>
            </div>
            @if ($user->profile)
                <p class="font-weight-bold mb-4 mt-4">{!! nl2br(e($user->profile)) !!}</p>
            @else
                <p class="font-weight-bold mb-4 mt-4 text-muted">※プロフィールが設定されていません。</p>
            @endif
        </div>
    </div>
    <div class = "ml-3 mb-4 row">
        @include('user_follow.follow_button')
        @include('user_mute.mute_button')
    </div>
    @include('stulogs.stulogs')
@endsection