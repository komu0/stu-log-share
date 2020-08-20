<div class="modal" id=tagToAnotherCategory{{$i}}_{{$j}} tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">タグ「{{$tag->name}}」を別のカテゴリに移動する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                @if (count($tag->movable_category_names()) > 0)
                {{$category->name}}→
                {!! Form::open( ['route' => ['update.tag.category', $tag->id], 'method' => 'put']) !!}
                <div class="row ml-3">
                    <div class="d-flex align-items-center">
                        {!! Form::select("category_name", $tag->movable_category_names(), ['class' => 'form-control']) !!}
                    </div>
                </div>
                @else
                移動できるカテゴリがありません。
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                {!! Form::submit('移動', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
