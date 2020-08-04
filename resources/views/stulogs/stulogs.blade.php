@if (count($stulogs) > 0)
    <ul class="list-unstyled">
        @foreach ($stulogs as $stulog)
            <li class="media mb-4">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        <span>ID:</span>
                        {!! link_to_route('users.show', $stulog->user_id, ['user' => $stulog->user_id]) !!}
                        <span>{{ $stulog->log_date->format('Y年m月d日') }}</span>
                        <span>勉強時間：{{ $stulog->study_time_H }}時間{{ $stulog->study_time_M }}分</span>
                        <span class="text-muted">posted at {{ $stulog->created_at }}</span>
                        @if (Auth::check())
                            @if (Auth::user()->id == $stulog->user_id)
                                {!! link_to_route('stulogs.edit', '編集', ['stulog' => $stulog->id]) !!}
                            @endif
                        @endif
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
    {{ $stulogs->links() }}
@endif