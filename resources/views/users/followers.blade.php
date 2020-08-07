@extends('layouts.app')

@section('content')
    <h2>ID: {!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}をフォローしているユーザ / {{ $user->followers_count }}人</h2>
    @include('users.users')
@endsection