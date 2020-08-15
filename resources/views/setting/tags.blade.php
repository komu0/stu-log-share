@extends('layouts.app')
@section('content')
<h2>タグの管理</h2>
<section class="mb-3">
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
      カテゴリの追加
    </button>
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
      カテゴリ表示順の変更
    </button>
    <br>
    @foreach ($user->categories as $category)
        <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#exampleModal">
            {{$category->name}}
        </button>
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            タグの追加
        </button>
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
             タグ表示順の変更
        </button>
        <br>
        @foreach ($category->tags as $tag)
            <span>　　</span>
            <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#exampleModal">
                {{$tag->name}}
            </button>
            <br>
        @endforeach
    @endforeach
</section>
@endsection