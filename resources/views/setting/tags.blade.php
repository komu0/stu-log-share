@extends('layouts.app')
@section('content')
<h2>タグの管理</h2>
<section class="mb-3 offset-3 col-sm-6 bg-light p-4">
    <a data-toggle="collapse" href="#collapseCategories" aria-expanded="true">
    <small>▼</small>
    </a>
    <div class="btn-group dropright">
        <a href="#" data-toggle="dropdown">
            {{$user->id}}
        </a>
        <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
            <a class="dropdown-item" data-toggle="modal" data-target="#addCategory">カテゴリの追加</a>
            @if (count($user->categories)>=2)
            <a class="dropdown-item" data-toggle="modal" data-target="#changeCategoryOrder">カテゴリの表示順を変更</a>
            @endif
        </div>
    </div><br>
    <div class="collapse show ml-4" id="collapseCategories">
        @foreach ($user->categories as $i => $category)
        <div>
            <a data-toggle="collapse" href="#collapseTags{{$category->id}}" aria-expanded="true">
            <small>▼</small>
            </a>
            <div class="btn-group dropright">
                <a href="#" data-toggle="dropdown">
                    {{$category->name}}
                </a>
                <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target=#addTagOn{{$i}}>タグの追加</a>
                    @if (count($category->tags)>=2)
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target=#changeTagOrderOn{{$i}}>タグの表示順を変更</a>
                    @endif
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target=#changeCategoryName{{$i}}>名前の変更</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target=#deleteCategory{{$i}}>削除</a>
                </div>
            </div>
            <div class="collapse show" id="collapseTags{{$category->id}}">
                <ul>
                    @foreach ($category->tags as $j => $tag)
                    <li>
                        <div class="btn-group dropright">
                            <a href="#" data-toggle="dropdown">
                                {{$tag->name}}
                            </a>
                            <div class="dropdown-menu" x-placement="right-start" style="position: absolute; transform: translate3d(111px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target=#tagToAnotherCategory{{$i}}_{{$j}}>カテゴリの移動</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target=#changeTagName{{$i}}_{{$j}}>名前の変更</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target=#deleteTag{{$i}}_{{$j}}>削除</a>
                            </div>
                        </div>
                    </li>
                    @include('modal.change_tag_name')
                    @include('modal.check_delete_tag')
                    @include('modal.tag_to_another_category')
                    @endforeach
                </ul>
            </div>
        </div>
        @include('modal.add_tag')
        @include('modal.change_tag_order')
        @include('modal.change_category_name')
        @include('modal.check_delete_category')
        @endforeach
    </div>
</section>
@include('modal.add_category')
@include('modal.change_category_order')












<section class="mb-3">
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addCategory">
      カテゴリの追加
    </button>
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
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target=#addTagOn{{$i}}>
            タグの追加
        </button>
        @if (count($category->tags)>=2)
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target=#changeTagOrderOn{{$i}}>
             タグ表示順の変更
        </button>
        @endif
        <br>
        @foreach ($category->tags as $j => $tag)
            <span>　　</span>
            <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target=#editTag{{$i}}_{{$j}}>
                {{$tag->name}}
            </button>
            <br>
        @endforeach
    @endforeach
</section>
@endsection