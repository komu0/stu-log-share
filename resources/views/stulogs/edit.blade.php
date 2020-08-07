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
        
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
          この投稿を削除
        </button>
        
        <!-- Modal -->
        <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">スタログの削除</h5>
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

    </div>
</div>
@endsection