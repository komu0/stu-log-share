@extends('layouts.app')

@section('content')
    <p>ID: {!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}をフォローしているユーザ<br>
    {{ $user->followers_count }}人</p>
    <h2>ユーザ一覧</h2>
    @include('users.users')
@endsection