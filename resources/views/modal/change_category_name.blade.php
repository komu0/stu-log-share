<div class="modal" id="changeCategoryName{{$i}}" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">カテゴリ名を変更する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                {{$category->name}}→
                <div class="ml-3">
                    {!! Form::open( ['route' => ['update.category.name', $category->id], 'method' => 'put']) !!}
                    <div class="row">
                        <div>
                            {!! Form::text("name", $category->name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    {!! Form::submit('変更', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
