@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-6">
        {!! Form::model($user, ['route' => ['profile.update'], 'method' => 'put']) !!}
            <div class="form-group">
                {!! Form::label('profile', 'プロフィール:') !!}
                {!! Form::textarea('profile', null, ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('編集', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection