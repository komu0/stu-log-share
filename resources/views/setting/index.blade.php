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
                {!! Form::open(['route' => ['password.update'], 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('current-password', '現在のパスワード：') !!}
                        {!! Form::password('current-password', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', '新しいパスワード：') !!}
                        {!! Form::password('password', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', '新しいパスワード(確認)：') !!}
                        {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
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
            <div class="card-header">その他の設定</div>
            <div class="card-body">
                {!! link_to_route('user.mutings', 'ミュート中のユーザ管理', [], ['class' => 'h-auto btn btn-lg btn-primary']) !!}
                {!! link_to_route('setting.tags', 'タグの管理', [], ['class' => 'h-auto btn btn-lg btn-primary']) !!}
            </div>
        </div>
    </div>
</div>

@endsection