@extends('layouts.app')
@section('content')
<h1 class="mb-4">{{ $user->id }}さんの分析ページ</h1>
<section class="mb-3">
    <h2>勉強時間内訳</h2>
    総勉強時間：{{$user->display_study_time()}}<br>
    @foreach ($user->categories as $category)
        <span>　</span>{{$category->name}}：{{ $category->display_study_time() }}<br>
        @foreach ($category->tags as $tag)
            <span>　　</span>{{$tag->name}}：{{ $tag->display_study_time() }}<br>
        @endforeach
    @endforeach
</section>
<section class="mb-3">
    <h2>勉強時間推移</h2>
    <p>最終的にはグラフを書く</p>
    <div class="row">
    @foreach ($timeTransArray as $name=>$timeTrans)
        <div class="col-md-2">
        {{$name}}<br>
        @foreach ($timeTrans as $date=>$time)
            {{$date}}：{{$time}}<br>
        @endforeach
        <br>
        </div>
    @endforeach
    </div>
</section>
@endsection