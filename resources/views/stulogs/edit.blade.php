@extends('layouts.app')
@section('content')
<div class="mb-4">
  <h1 class="mb-3">ログを編集</h1>
  {!! Form::model($stulog, ['route' => ['stulogs.update', $stulog->id], 'method' => 'put']) !!}
  <div class="mb-3">
    <div class="row">
      <div class="d-flex align-items-end">
        {!! Form::label('log_date', '日付:') !!}
      </div>
      <div class="col-4">
        {!! Form::date('log_date', $stulog->log_date, ['class' => 'form-control']) !!}
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
          {!! Form::text("contentsArray[$i][タグ]", old($contentsArray[$i]['タグ'],$contentsArray[$i]['タグ']) , ['class' => 'form-control']) !!}
      </div>
      <div class="col-2">
          {!! Form::time("contentsArray[$i][勉強時間]", old($contentsArray[$i]['勉強時間'],$contentsArray[$i]['勉強時間']), ['class' => 'form-control']) !!}
      </div>
      <div class="col-7">
          {!! Form::text("contentsArray[$i][内容]", old($contentsArray[$i]['内容'],$contentsArray[$i]['内容']), ['class' => 'form-control']) !!}
      </div>
    </div>
    @endforeach
  </div>
  <div class="mb-3">
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