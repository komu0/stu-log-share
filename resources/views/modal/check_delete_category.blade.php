<div class="modal" id="deleteCategory{{$i}}" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">カテゴリを削除する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-2">
                カテゴリ「{{$category->name}}」本当に削除しますか？<br>
                <small>
                ※含まれるタグはすべて削除されます。<br>
                ※含まれるタグが既にスタログと関連しているカテゴリは削除できません。
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>    
                {!! Form::model($category, ['route' => ['category.destroy',$category->id], 'method' => 'delete']) !!}
                    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>