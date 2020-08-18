<div class="modal" id=editTag{{$i}}_{{$j}} tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">タグの編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                {!! Form::open( ['route' => ['update.tag.name', $tag->id], 'method' => 'put']) !!}
                <div class="row">
                    <div class="form-group">
                        {!! Form::text("name", $tag->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group d-flex align-items-center ml-2">
                        {!! Form::submit('名前の変更', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <div class="form-group d-flex align-items-center">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=#deleteTag{{$i}}>
                            削除
                        </button>
                        @include ('modal.check_delete_tag')
                    </div>
                </div>
                <div class="row">
                    <div class="form-group d-flex align-items-center">
                        {!! Form::select("category_name", $tag-> movable_category_names(), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group d-flex align-items-center ml-2">
                        {!! Form::submit('カテゴリの変更', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
            </div>
        </div>
    </div>
</div>
