@if (count($users) > 0)
    @foreach ($users as $user)
        <div class="mb-4 offset-1 col-10 border rounded">
            <div class="row p-2">
                <div class="d-flex align-items-center col-xl-9 col-lg-8 col-md-7">
                    <span>ID:
                    {!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}
                    @if ($user->profile)
                        <br>{!! nl2br(e($user->profile)) !!}
                    @endif
                    </span>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-5 d-flex justify-content-end">
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