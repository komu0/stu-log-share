@extends('layouts.app')

@section('content')
    <h2>ID: {!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}がフォローしているユーザ / {{ $user->followings_count }}人</h2>
    @include('users.users')
@endsection