<div class="modal" id="updateImage" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">アイコンを編集する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['image.update'], 'method' => 'put', 'files' => true]) !!}
                <img class="mb-3" src="{{ Storage::disk('s3')->url($user->image_path) }}" alt="avatar_image" />
                {!! Form::file('file') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                {!! Form::submit('アップロード', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
