<div class="modal" id="tagAnalyze{{$tag->id}}" tabindex="-1" aria-hidden="true";>
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">タグ「{{$tag->name}}」の勉強時間の分析</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-3">
                <div class="mb-3">
                カテゴリ「{{$tag->name}}」の勉強時間は{{$tag->study_time()}}時間です。<br>
                </div>
                <a data-toggle="collapse" href="#collapseTagTrans{{$tag->id}}" aria-expanded="true" class="btn btn-primary">
                    推移
                </a>
                <div class="collapse mt-2" id="collapseTagTrans{{$tag->id}}">
                    @foreach ($category->time_trans_array() as $key => $time)
                        {{$key}}：{{$time}}時間<br>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
            </div>
        </div>
    </div>
</div>