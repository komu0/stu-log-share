<div class="modal" id="deleteTag{{$i}}_{{$j}}" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                タグ「{{$tag->name}}」を本当に削除しますか？
            </div>
            <div class="modal-footer">
                {!! Form::model($tag, ['route' => ['tag.destroy',$tag->id], 'method' => 'delete']) !!}
                    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>