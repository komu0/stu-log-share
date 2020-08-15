@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h1>ログを投稿</h1>
    {!! Form::model($stulog, ['route' => 'stulogs.store']) !!}
        <div class="row form-group col-sm-3">
            {!! Form::label('log_date', '日付:') !!}
            {!! Form::date('log_date', null, ['class' => 'form-control']) !!}
        </div>
        
        @foreach($contentsArray as $i => $content)
        <div class="row">
          <div class="d-flex align-items-end mb-3">
              {!! Form::label(sprintf('%02d',$i + 1)) !!}
          </div>
          <div class="form-group col-sm-2">
            @if ($i == 0)
              {!! Form::label('tag_name', 'タグ') !!}
            @endif
              {!! Form::text("contentsArray[$i][タグ]", old($contentsArray[$i]['タグ']) , ['class' => 'form-control']) !!}
          </div>
          <div class="form-group col-sm-2">
            @if ($i == 0)
              {!! Form::label('study_time', '勉強時間') !!}
            @endif
              {!! Form::time("contentsArray[$i][勉強時間]", old($contentsArray[$i]['勉強時間']), ['class' => 'form-control']) !!}
          </div>
          <div class="form-group col-sm-7">
            @if ($i == 0)
              {!! Form::label('content', '内容') !!}
            @endif
              {!! Form::text("contentsArray[$i][内容]", old($contentsArray[$i]['内容']), ['class' => 'form-control']) !!}
          </div>
        </div>
        @endforeach
      
        <div class="form-group">
            {!! Form::label('thought', '感想:') !!}
            {!! Form::textarea('thought', null, ['class' => 'form-control']) !!}
        </div>
        
        {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-lg']) !!}
    {!! Form::close() !!}
    </div>
</div>
@endsection