@if (count($allStulogs) > 0)
    <ul class="list-unstyled">
        @foreach ($allStulogs as $stulog)
            <li class="media mb-3">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        <span>ID:</span>
                        {!! link_to_route('users.show', $stulog->user_id, ['user' => $stulog->user_id]) !!}
                        <span>{{ $stulog->log_date->format('Y年m月d日') }}</span>
                        <span>勉強時間：{{ $stulog->study_time_H }}時間{{ $stulog->study_time_M }}分</span>
                        
                        <span class="text-muted">posted at {{ $stulog->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($stulog->content)) !!}</p>
                        <p class="mb-0">{!! nl2br(e($stulog->thought)) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $allStulogs->links() }}
@endif