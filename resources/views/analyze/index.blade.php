@extends('layouts.app')
@section('content')
<h1 class="mb-4">{!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}さんの分析ページ</h1>
<section class="mb-3">
    <h2>勉強時間内訳</h2>
    <div>
        <a data-toggle="collapse" href="#collapseCategories" aria-expanded="true">
        <small>▼</small>
        </a>
        総勉強時間：{{$user->display_study_time()}}<br>
    </div>
    <div class="collapse show ml-4" id="collapseCategories">
        @foreach ($user->categories as $i => $category)
        <div>
            <a data-toggle="collapse" href="#collapseTags{{$category->id}}" aria-expanded="true">
            <small>▼</small>
            </a>
            {{$category->name}}：{{ $category->display_study_time() }}
            <div class="collapse show ml-4" id="collapseTags{{$category->id}}">
                @foreach ($category->tags as $j => $tag)
                <li>
                    {{$tag->name}}：{{ $tag->display_study_time() }}
                </li>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
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