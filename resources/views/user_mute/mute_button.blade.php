 @if (Auth::check())
    @if (Auth::id() != $user->id)
        @if (Auth::user()->is_muting($user->id))
            {{-- アンミュートボタンのフォーム --}}
            {!! Form::open(['route' => ['user.unmute', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('ミュート中', ['class' => "btn-danger btn"]) !!}
            {!! Form::close() !!}
        @else
            {{-- ミュートボタンのフォーム --}}
            {!! Form::open(['route' => ['user.mute', $user->id]]) !!}
                {!! Form::submit('ミュート', ['class' => "btn btn-light"]) !!}
            {!! Form::close() !!}
        @endif
    @endif
@endif