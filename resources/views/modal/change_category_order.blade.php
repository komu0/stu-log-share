<div class="modal" id="changeCategoryOrder" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">カテゴリ表示順を変更する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <div class="mb-2">
                    あなたのカテゴリは、様々な場所で、<br>
                    優先順位の若い順に表示されます。<br>
                    優先順位は1～9999の数字で指定してください。
                </div>
                @foreach ($user->categories as $category)
                {!! Form::model($category, ['route' => 'update.category.order', 'method' => 'put']) !!}
                <div class="row mb-1">
                    <div class="d-flex align-items-end col-sm-3">
                        {!! Form::label("order[$category->id]", $category->name) !!}
                    </div>
                    <div class="d-flex align-items-end col-sm-3">
                        {!! Form::number("order[$category->id]", $category->order, ['class' => 'form-control']) !!}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                {!! Form::submit('変更', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
