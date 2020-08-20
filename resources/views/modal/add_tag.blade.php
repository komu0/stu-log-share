<div class="modal" id="addTagOn{{$i}}" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">カテゴリ「{{$category->name}}」にタグを追加する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-3">
                {!! Form::model($category->tag, ['route' => ['tags.store', $category->id]]) !!}
                    <div class="row">
                        <div class="d-flex align-items-end mr-2">
                            {!! Form::label('name', 'タグ名:') !!}
                        </div>
                        <div>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>