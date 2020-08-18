<div class="modal" id=editCategory{{$i}} tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">カテゴリの編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                {!! Form::open( ['route' => ['update.category.name', $category->id], 'method' => 'put']) !!}
                <div class="row">
                    <div class="form-group">
                        {!! Form::text("name", $category->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group d-flex align-items-center ml-2">
                        {!! Form::submit('名前の変更', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <div class="form-group d-flex align-items-center">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target=#deleteCategory{{$i}}>
                            削除
                        </button>
                        @include ('modal.check_delete_category')
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
            </div>
        </div>
    </div>
</div>
