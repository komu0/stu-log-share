@if (count($stulogs) > 0)
    @foreach ($stulogs as $stulog)
        <div class="mb-4 offset-1 col-10 bg-light p-2">
            <div>
                <div class="d-sm-inline">
                    <span>ID:</span>
                    <span>{!! link_to_route('users.show', $stulog->user_id, ['user' => $stulog->user_id]) !!}</span>
                    <span> / </span>
                    <span>{{ $stulog->log_date->format('Y年m月d日') }}</span>
                    <span> / </span>
                </div>
                <div class="d-sm-inline">
                    <span>勉強時間:</span> 
                    <span class="mr-3 font-weight-bold">{{ $stulog->study_time_H }}時間{{ $stulog->study_time_M }}分</span>
                </div>
                @if (Auth::check())
                    @if (Auth::user()->id == $stulog->user_id)
                        <span>{!! link_to_route('stulogs.edit', '編集', ['stulog' => $stulog->id]) !!}</span>
                    @endif
                @endif
            </div>
            <div>
                <div class="container mt-2 mb-2">
                    @if ($stulog->content != '')
                        <div class="row justify-content-center mb-1">
                            <div class="p-2 col-1 border-left border-top border-bottom border-secondary d-flex align-items-center rounded-left">内容</div>
                            <div class="p-2 col-9 border border-secondary d-flex align-items-center rounded-right">{!! nl2br(e($stulog->content)) !!}</div>
                        </div>
                    @endif
                    @if ($stulog->thought != '')
                        <div class="row justify-content-center mb-1">
                            <div class="p-2 col-1 border-left border-top border-bottom border-secondary d-flex align-items-center rounded-left">感想</div>
                            <div class="p-2 col-9 border border-secondary d-flex align-items-center rounded-right">{!! nl2br(e($stulog->thought)) !!}</div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <span class="text-muted">posted at {{ $stulog->created_at }}</span>
            </div>
        </div>
    @endforeach
    {{ $stulogs->links() }}
@endif