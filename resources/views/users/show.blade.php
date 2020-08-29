@extends('layouts.app')

@section('content')
    <h2 class="mb-4">
        {{$user->id}}さんのユーザページ
        {!! link_to_route('analyze', '分析', ['id' => $user->id], ['class' => 'h-auto btn btn-sm btn-success']) !!}
    </h2>
    <div class="row mb-3">
        <div class="col-md-2 col-sm-4 offset-sm-0 offset-3 col-6">
            <img class="img-fluid mb-2" src="{{ Storage::disk('s3')->url($user->image_path) }}" alt="avatar_image" />
            @if (Auth::check())
                @if (Auth::user()->id == $user->id)
                    <div class="btn btn-block btn-primary btn-sm" href="#" data-toggle="modal" data-target=#updateImage>アイコンを変更</div>
                @endif
            @endif
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
            <div class="row mt-4 mb-4">
            @if ($user->profile)
                <div class="ml-2 mr-2 p-2 font-weight-bold col-sm-8 border border-primary rounded">{!! nl2br(e($user->profile)) !!}</div>
            @else
                <div  class="ml-2 mr-2 p-2 font-weight-bold col-sm-8 border border-primary rounded text-muted">※プロフィールが設定されていません。</div>
            @endif
            @if (Auth::check())
                @if (Auth::user()->id == $user->id)
                    <div class="ml-2 d-flex align-items-end">
                        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target=#updateProfile>編集</a>
                    </div>
                @endif
            @endif
            </div>
        </div>
    </div>
    <div class = "ml-3 mb-4 row">
        @include('user_follow.follow_button')
        @include('user_mute.mute_button')
    </div>
    @include('stulogs.stulogs')
@include('modal.update_profile')
@include('modal.update_image')
@endsection