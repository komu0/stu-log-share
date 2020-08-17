<div class="modal" id="changeCategoryOrder" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">カテゴリ表示順の変更</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                {!! Form::model($category, ['route' => 'update.category.order', 'method' => 'put']) !!}
                    <p>あなたのカテゴリは、様々な場所で、優先順位の若い順に表示されます。<br>
                    優先順位は1～9999の数字で指定してください。</p>
                    @foreach ($user->categories as $category)
                    <div class="row">
                        <div class="form-group d-flex align-items-end mr-2">
                            {!! Form::label("order[$category->id]", $category->name) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::number("order[$category->id]", $category->order, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
                {!! Form::submit('変更', ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
