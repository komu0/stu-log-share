@extends('layouts.app')
@section('content')
<h2 class="text-center">設定</h2>
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">プロフィール変更</div>
            <div class="card-body">
                {!! Form::model($user, ['route' => ['profile.update'], 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::textarea('profile', null, ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('変更', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">パスワード変更</div>
            <div class="card-body">
                <div class="mb-3">
                    {!! Form::open(['route' => ['password.update'], 'method' => 'put']) !!}
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-4 col-lg-5 col-md-6 col-12 pr-0">
                            現在のパスワード：
                        </div>
                        <div class="col-6">
                            {!! Form::password('current-password', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-4 col-lg-5 col-md-6 col-12 pr-0">
                            新しいパスワード：
                        </div>
                        <div class="col-6">
                            {!! Form::password('password', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-4 col-lg-5 col-md-6 col-12 pr-0">
                            新しいパスワード(確認)：
                        </div>
                        <div class="col-6">
                            {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::submit('変更', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">プロフィール画像の変更</div>
            <div class="card-body">
                <div class="form-group">
                {!! Form::open(['route' => ['image.update'], 'method' => 'put', 'files' => true]) !!}
                    <p>
                        <img src="{{ Storage::disk('s3')->url($user->image_path) }}" alt="avatar_image" />
                    </p>
                    {!! Form::file('file',['class' => 'mb-3']) !!}
                    <div class="form-group">
                        {!! Form::submit('アップロード', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">その他の設定</div>
            <div class="card-body pb-1">
                <ul>
                    <li>{!! link_to_route('user.mutings', 'ミュート中のユーザ管理', []) !!}</li>
                    <li>{!! link_to_route('settings.tags', 'タグの管理', [],) !!}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection