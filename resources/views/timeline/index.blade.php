@extends('layouts.app')
@section('content')
    @include('timeline.topcard')
    <div class="tab-content">
        @include('stulogs.stulogs')
    </div>
@endsection