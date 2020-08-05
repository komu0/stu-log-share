@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media mb-3">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <span>ID:</span>
                                {!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}
                                <span>{{ $user->profile }}</span>
                            </div>
                            @include('user_follow.follow_button')
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $users->links() }}
@endif