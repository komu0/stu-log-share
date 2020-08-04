@extends('layouts.app')
@section('content')
<h1>ログを投稿</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($stulog, ['route' => 'stulogs.store']) !!}

                <div class="form-group">
                    {!! Form::label('log_date', '日付:') !!}
                    {!! Form::date('log_date', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('study_time', '勉強時間:') !!}
                    {!! Form::time('study_time', null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', '内容:') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('thought', '感想:') !!}
                    {!! Form::textarea('thought', null, ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection