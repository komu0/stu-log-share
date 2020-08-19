<div class="modal" id="addTagOn{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">「{{$category->name}}」へのタグの追加</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                {!! Form::model($category->tag, ['route' => ['tags.store', $category->id]]) !!}
                    <div class="row">
                        <div class="form-group d-flex align-items-end mr-2">
                            {!! Form::label('name', 'タグ名:') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
                {!! Form::submit('追加', ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>