<div class="modal" id="all_study_time" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">総勉強時間の分析</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-3">
                <div class="mb-3">
                総勉強時間は{{$user->study_time()}}時間です。<br>
                @if ($user->study_time() > 0)
                    内訳は、<br>
                    @foreach ($user->categories as $i => $category)
                        ・{{$category->name}}が{{$category->study_time()}}時間で全体の{{$category->study_time_percentage()}}%<br>
                    @endforeach
                    です。
                @endif
                </div>
                <a data-toggle="collapse" href="#collapseAllTrans" aria-expanded="true" class="btn btn-primary">
                    推移
                </a>
                <div class="collapse mt-2" id="collapseAllTrans">
                    @foreach ($user->time_trans_array() as $key => $time)
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