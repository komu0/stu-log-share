@extends('layouts.app')

@section('content')
    <p>ID:{{ $user->id }}がフォローしているユーザ<br>
    {{ $user->followings_count }}人</p>
    <h2>ユーザ一覧</h2>
    @include('users.users')
@endsection