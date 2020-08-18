@extends('layouts.app')
@section('content')
<h2>タグの管理</h2>
<section class="mb-3">
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addCategory">
      カテゴリの追加
    </button>
    @include('modal.add_category')
    @if (count($user->categories)>=2)
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#changeCategoryOrder">
      カテゴリ表示順の変更
    </button>
    @include('modal.change_category_order')
    @endif
    <br>
    @foreach ($user->categories as $i => $category)
        <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target=#editCategory{{$i}}>
            {{$category->name}}
        </button>
        @include ('modal.edit_category')
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target=#addTagOn{{$i}}>
            タグの追加
        </button>
        @include ('modal.add_tag')
        @if (count($category->tags)>=2)
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target=#changeTagOrderOn{{$i}}>
             タグ表示順の変更
        </button>
        @include ('modal.change_tag_order')
        @endif
        <br>
        @foreach ($category->tags as $j => $tag)
            <span>　　</span>
            <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target=#editTag{{$i}}_{{$j}}>
                {{$tag->name}}
            </button>
            @include ('modal.edit_tag')
            <br>
        @endforeach
    @endforeach
</section>
@endsection