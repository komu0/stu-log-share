<div class="modal" id="categoryAnalyze{{$category->id}}" tabindex="-1" aria-hidden="true";>
     <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">カテゴリ「{{$category->name}}」の勉強時間の分析</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ml-3">
                <div class="mb-3">
                    カテゴリ「{{$category->name}}」の勉強時間は{{$category->study_time()}}時間です。<br>
                    @if ($category->study_time() > 0)
                        内訳は、<br>
                        @foreach ($category->tags as $i => $tag)
                            ・{{$tag->name}}が{{$tag->study_time()}}時間で全体の{{$tag->study_time_percentage()}}%<br>
                        @endforeach
                        です。
                    @endif
                </div>
                <a data-toggle="collapse" href="#collapseCategoryTrans{{$category->id}}" aria-expanded="true" class="btn btn-primary">
                    推移
                </a>
                <div class="collapse mt-2" id="collapseCategoryTrans{{$category->id}}">
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