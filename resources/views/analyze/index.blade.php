@extends('layouts.app')
@section('content')
<h1>{{ $user->id }}さんの分析ページ</h1>
<h2>総勉強時間：{{$user->study_time()}}</h3>
@foreach ($user->categories as $category)
    {{$category->name}}：{{ $category->study_time() }}<br>
    @foreach ($category->tags as $tag)
        ┗　{{$tag->name}}：{{ $tag->study_time() }}<br>
    @endforeach
@endforeach
@endsection
