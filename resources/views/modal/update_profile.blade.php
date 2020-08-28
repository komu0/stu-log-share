<div class="modal" id="updateProfile" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">プロフィールを編集する</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    {!! Form::model($user, ['route' => ['profile.update'], 'method' => 'put']) !!}
                    {!! Form::textarea('profile', null, ['class' => 'form-control']) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    {!! Form::submit('変更', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
