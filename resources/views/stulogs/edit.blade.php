@extends('layouts.app')
@section('content')
<h1>ログを編集</h1>
<div class="row mb-4">
    <div class="col-6">
        {!! Form::model($stulog, ['route' => ['stulogs.update', $stulog->id], 'method' => 'put']) !!}
        
            <div class="form-group">
                {!! Form::label('log_date', '日付:') !!}
                {!! Form::date('log_date', $stulog->log_date, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('study_time', '勉強時間:') !!}
                {!! Form::time('study_time', $study_time, ['class' => 'form-control']) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('content', '内容:') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('thought', '感想:') !!}
                {!! Form::textarea('thought', null, ['class' => 'form-control']) !!}
            </div>
            
            {!! Form::submit('編集', ['class' => 'btn btn-primary btn-lg mb-4']) !!}

        {!! Form::close() !!}
        {{-- 投稿削除ボタンのフォーム --}}
        {!! Form::open(['route' => ['stulogs.destroy', $stulog->id], 'method' => 'delete']) !!}
            {!! Form::submit('この投稿を削除', ['class' => 'btn btn-danger btn-sm']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection