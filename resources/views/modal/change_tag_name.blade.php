<div class="modal" id="changeTagName{{$i}}_{{$j}}" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">タグ名の変更</h5>
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
                    {!! Form::submit('変更', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
