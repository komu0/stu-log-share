<div class="modal" id=tagToAnotherCategory{{$i}}_{{$j}} tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">カテゴリの移動</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                @if (count($tag->movable_category_names()) > 0)
                {!! Form::open( ['route' => ['update.tag.category', $tag->id], 'method' => 'put']) !!}
                <div class="row">
                    <div class="form-group d-flex align-items-center">
                        {!! Form::select("category_name", $tag->movable_category_names(), ['class' => 'form-control input-lg']) !!}
                    </div>
                </div>
                @else
                <p>移動できるカテゴリがありません。</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
                {!! Form::submit('移動', ['class' => 'btn btn-primary btn-sm']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
