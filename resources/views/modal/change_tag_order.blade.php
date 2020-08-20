<div class="modal" id=changeTagOrderOn{{$i}} tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">カテゴリ「{{$category->name}}」のタグ表示順を変更する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <div class="mb-2">
                    あなたのタグは、様々な場所で、<br>
                    優先順位の若い順に表示されます。<br>
                    優先順位は1～9999の数字で指定してください。
                </div>
                @foreach ($category->tags as $tag)
                {!! Form::model($tag,['route' => 'update.tag.order', 'method' => 'put']) !!}
                <div class="row">
                    <div class="d-flex align-items-end col-sm-3">
                        {!! Form::label("order[$tag->id]", $tag->name) !!}
                    </div>
                    <div class="d-flex align-items-end col-sm-3">
                        {!! Form::number("order[$tag->id]", $tag->order, ['class' => 'form-control']) !!}
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
