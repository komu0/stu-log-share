@if (count($users) > 0)
    @foreach ($users as $user)
        <div class="mb-4 offset-sm-1 col-sm-10 col-12 border rounded">
            <div class="row p-2">
                <div class="col-lg-1 col-md-2 col-sm-3 col-4 p-0">
                    <img class="img-fluid" src="{{ Storage::disk('s3')->url($user->image_path) }}" alt="avatar_image" />
                </div>
                <div class="col-xl-8 col-lg-7 col-md-10 col-sm-9 col-8">
                    <span>ID:
                    {!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}
                    @if ($user->profile)
                        <br>{!! nl2br(e($user->profile)) !!}
                    @endif
                    </span>
                </div>
                <div class="col-xl-3 col-lg-4 d-flex justify-content-end p-0">
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
    <div class="d-flex justify-content-center mb-5">
        {{ $users->onEachSide(1)->links() }}
    </div>
@else
    <p class="text-center">表示できるユーザ情報がありません。</p>
@endif