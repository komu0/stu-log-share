@if (count($users) > 0)
    @foreach ($users as $user)
        <div class="mb-4 offset-1 col-10 p-2 border border-primary rounded">
            <div class="row">
                <div class="d-flex align-items-center col-9">
                    <span>ID:
                    {!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}
                    @if ($user->profile)
                        <br>　{{ $user->profile }}
                    @endif
                    </span>
                </div>
                <div class="row w-25 d-flex justify-content-end">
                    @if (Auth::check())
                        @if (\Auth::user()->mutings()->where('mute_id', $user->id)->exists())
                            <div class="d-flex align-items-center">
                                @include('user_mute.mute_button')
                            </div>
                        @endif
                    @endif
                    <div class="d-flex align-items-center">
                        @include('user_follow.follow_button')
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $users->links() }}
@else
    <p class="text-center">表示できるユーザ情報がありません。</p>
@endif