 @if (Auth::check())
    @if (Auth::id() != $user->id)
        @if (Auth::user()->is_following($user->id))
            {{-- アンフォローボタンのフォーム --}}
            {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('フォロー中', ['class' => "btn-primary btn"]) !!}
            {!! Form::close() !!}
        @else
            {{-- フォローボタンのフォーム --}}
            {!! Form::open(['route' => ['user.follow', $user->id]]) !!}
                {!! Form::submit('フォロー', ['class' => "btn btn-light"]) !!}
            {!! Form::close() !!}
        @endif
    @endif
@endif