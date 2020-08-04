@extends('layouts.app')
@section('content')
    @include('timeline.topcard')
    <ul class="nav nav-tabs mb-5">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">みんなのログ</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('timeline') }}" class="nav-link active">タイムライン</a>
        </li>
    </ul>
    <div class="tab-content">
        @include('stulogs.stulogs')
    </div>
@endsection