@if (count($stulogs) > 0)
    @foreach ($stulogs as $stulog)
        <div class="p-2 mb-4 offset-1 col-10 bg-light border rounded">
            <div class="d-sm-inline">
                <span>ID:</span>
                <span>{!! link_to_route('users.show', $stulog->user_id, ['user' => $stulog->user_id]) !!}</span>
                <span> / </span>
            </div>
            <div class="d-sm-inline">
                <span>{{ $stulog->log_date->format('Y年m月d日') }}</span>
                <span> / </span>
            </div>
            <div class="d-inline">
                <span>勉強時間:</span> 
                <span class="mr-3 font-weight-bold">{{ $stulog->display_study_time() }}</span>
            </div>
            @if (Auth::check())
                @if (Auth::user()->id == $stulog->user_id)
                    <span>{!! link_to_route('stulogs.edit', '編集', ['stulog' => $stulog->id]) !!}</span>
                @endif
            @endif
            <div>
                <div class="container mt-2 mb-2">
                    <div class="mb-3">
                    @if ($stulog->contents != '')
                        @foreach ($stulog->contents as $content)
                        <div class="row border-bottom">
                            <div class="col-xl-2 col-md-3 font-weight-bold">{{ $content->tag->name }}</div>
                            <div class="col-xl-2 col-md-3">{{ $content->display_study_time() }}</div>
                            <div class="col-xl-8 col-md-6">{{ $content->comment }}</div><br>
                        </div>
                        @endforeach
                    @endif
                    </div>
                    @if ($stulog->thought != '')
                        <div class="row justify-content-center mb-1">
                            <div class="col-lg-1 col-sm-2 col-10 p-2 border border-secondary d-flex align-items-center">感想</div>
                            <div class="col-lg-10 col-sm-9 col-10 p-2 border border-secondary d-flex align-items-center">{!! nl2br(e($stulog->thought)) !!}</div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <span class="text-muted">posted at {{ $stulog->created_at }}</span>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $stulogs->onEachSide(1)->links() }}
    </div>
@else
    <p class="text-center">表示できるスタログがありません。</p>
@endif