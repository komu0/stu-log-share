@extends('layouts.app')
@section('content')
<div class="mb-4 col-12">
  <h2 class="mb-3">ログを編集</h2>
  {!! Form::model($stulog, ['route' => ['stulogs.update', $stulog->id], 'method' => 'put']) !!}
  <div class="mb-3">
    <div class="row">
      <div class="d-flex align-items-end">
        {!! Form::label('log_date', '日付:') !!}
      </div>
      <div class="col-lg-3 col-md-4 col-sm-5 col-10">
        {!! Form::date('log_date', $stulog->log_date, ['class' => 'form-control']) !!}
      </div>
    </div>
  </div>
  <div class="mb-3">
  <div class="mb-3">
    <div class="d-none d-sm-inline">
      <div class="row">
        <div class="d-flex align-items-end">##</div>
        <div class="col-lg-2 col-sm-3 col-5">タグ</div>
        <div class="col-lg-2 col-sm-3 col-5">勉強時間</div>
        <div class="col-lg-7 col-sm-5 col-11">内容</div>
      </div>
    </div>
    <div class="d-sm-none mb-3">
      ※タグ・勉強時間・内容の順に入力してください。
    </div>
    @foreach($contentsArray as $i => $content)
    <div>
      <div class="d-flex align-items-end">
          {!! Form::label("num", sprintf('%02d',$i + 1), ['class'=>'d-sm-none']) !!}
      </div>
      <div class="row">
        <div class="d-flex align-items-end">
            {!! Form::label("num", sprintf('%02d',$i + 1), ['class'=>'d-none d-sm-inline']) !!}
        </div>
        <div class="col-lg-2 col-sm-3 col-7">
            {!! Form::text("contentsArray[$i][タグ]", old($contentsArray[$i]['タグ'],$contentsArray[$i]['タグ']) , ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-2 col-sm-3 col-7">
            {!! Form::time("contentsArray[$i][勉強時間]", old($contentsArray[$i]['勉強時間'],$contentsArray[$i]['勉強時間']), ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-7 col-sm-5 col-11">
            {!! Form::text("contentsArray[$i][内容]", old($contentsArray[$i]['内容'],$contentsArray[$i]['内容']), ['class' => 'form-control']) !!}
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="row mb-3">
    {!! Form::label('thought', '感想') !!}
    {!! Form::textarea('thought', null, ['class' => 'form-control']) !!}
  </div>
  <div class="row">
    {!! Form::submit('編集', ['class' => 'btn btn-primary btn-lg']) !!}
    {!! Form::close() !!}
    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#deleteModal">
      削除
    </button>
  </div>
</div>

<div class="modal" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">スタログの削除</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        この投稿を本当に削除しますか？
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
        {!! Form::open(['route' => ['stulogs.destroy', $stulog->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection