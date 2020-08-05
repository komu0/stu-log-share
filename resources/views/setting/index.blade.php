@extends('layouts.app')
@section('content')
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
                
                <!--以下、参考にしたコード>
                <!--<form method="post" action="{{route('password.update')}}">-->
                <!--    @csrf-->
                <!--    <div class="form-group">-->
                <!--        <label for="current">現在のパスワード</label>-->
                <!--        <div>-->
                <!--            <input id="current" type="password" class="form-control" name="current-password" required autofocus>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="form-group">-->
                <!--        <label for="password">新しいパスワード</label>-->
                <!--        <div>-->
                <!--            <input id="password" type="password" class="form-control" name="new-password" required>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="form-group">-->
                <!--        <label for="confirm">新しいパスワード（確認用）</label>-->
                <!--        <div>-->
                <!--            <input id="confirm" type="password" class="form-control" name="new-password_confirmation" required>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div>-->
                <!--        <button type="submit" class="btn btn-primary">変更</button>-->
                <!--    </div>-->
                <!--</form>-->
            </div>
        </div>
    </div>
</div>
@endsection