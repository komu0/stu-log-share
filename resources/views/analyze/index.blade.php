@extends('layouts.app')
@section('content')
<h2 class="mb-4">{!! link_to_route('users.show', $user->id, ['user' => $user->id]) !!}さんの分析ページ</h2>
<section class="mb-3">
    <h3>勉強時間内訳</h3>
    <div>
        <a data-toggle="collapse" href="#collapseCategories" aria-expanded="true">
            <small>▼</small>
        </a>
        <a href="#" data-toggle="modal" data-target=#all_study_time>
            総勉強時間：{{$user->display_study_time()}}<br>
        </a>
    </div>
    <div class="collapse show ml-4" id="collapseCategories">
        @foreach ($user->categories as $i => $category)
        <div>
            <a data-toggle="collapse" href="#collapseTags{{$category->id}}" aria-expanded="true">
                <small>▼</small>
            </a>
            <a href="#" data-toggle="modal" data-target="#categoryAnalyze{{$category->id}}">
                {{$category->name}}：{{ $category->display_study_time() }}
            </a>
            <div class="collapse show ml-4" id="collapseTags{{$category->id}}">
                @foreach ($category->tags as $j => $tag)
                <li>
                    <a href="#" data-toggle="modal" data-target="#tagAnalyze{{$tag->id}}">
                        {{$tag->name}}：{{ $tag->display_study_time() }}
                    </a>
                </li>
                @include('analyze.modal.tag_study_time')
                @endforeach
            </div>
        </div>
        @include('analyze.modal.category_study_time')
        @endforeach
    </div>
@include('analyze.modal.all_study_time')
</section>
<section class="mb-3">
    <h3>勉強時間推移</h3>
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