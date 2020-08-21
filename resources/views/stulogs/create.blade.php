@extends('layouts.app')
@section('content')
<div class="mb-4">
  <h1 class="mb-3">ログを投稿</h1>
  {!! Form::model($stulog, ['route' => 'stulogs.store']) !!}
  <div class="mb-3">
    <div class="row">
      <div class="d-flex align-items-end">
        {!! Form::label('log_date', '日付:') !!}
      </div>
      <div class="col-4">
        {!! Form::date('log_date', null, ['class' => 'form-control']) !!}
      </div>
    </div>
  </div>
  <div class="mb-3">
    <div class="row">
      <div class="d-flex align-items-end">##</div>
      <div class="col-2">タグ</div>
      <div class="col-2">勉強時間</div>
      <div class="col-7">内容</div>
    </div>
    @foreach($contentsArray as $i => $content)
    <div class="row">
      <div class="d-flex align-items-end">
          {!! Form::label(sprintf('%02d',$i + 1)) !!}
      </div>
      <div class="col-2">
          {!! Form::text("contentsArray[$i][タグ]", old($contentsArray[$i]['タグ']) , ['class' => 'form-control']) !!}
      </div>
      <div class="col-2">
          {!! Form::time("contentsArray[$i][勉強時間]", old($contentsArray[$i]['勉強時間']), ['class' => 'form-control']) !!}
      </div>
      <div class="col-7">
          {!! Form::text("contentsArray[$i][内容]", old($contentsArray[$i]['内容']), ['class' => 'form-control']) !!}
      </div>
    </div>
    @endforeach
  </div>
  <div class="mb-3">
    {!! Form::label('thought', '感想') !!}
    {!! Form::textarea('thought', null, ['class' => 'form-control']) !!}
  </div>
  <div class="row">
    {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-lg']) !!}
    {!! Form::close() !!}
  </div>
</div>  
@endsection