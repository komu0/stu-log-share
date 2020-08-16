@extends('layouts.app')
@section('content')
<h2>タグの管理</h2>
<section class="mb-3">
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addCategory">
      カテゴリの追加
    </button>
    <div class="modal" id="addCategory" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">カテゴリの追加</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body ml-2">
            {!! Form::model($category, ['route' => 'categories.store']) !!}
                <div class="row">
                  <div class="form-group d-flex align-items-end mr-2">
                    {!! Form::label('name', 'カテゴリ名:') !!}
                  </div>
                  <div class="form-group">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">キャンセル</button>
            {!! Form::submit('追加', ['class' => 'btn btn-primary btn-sm']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#changeCategoryOrder">
      カテゴリ表示順の変更
    </button>
    <br>
    @foreach ($user->categories as $i => $category)
        <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target=#editCategory{{$i}}>
            {{$category->name}}
        </button>
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target=#addTagOn{{$i}}>
            タグの追加
        </button>
        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target=#changeTagOrderOn{{$i}}>
             タグ表示順の変更
        </button>
        <br>
        @foreach ($category->tags as $j => $tag)
            <span>　　</span>
            <button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target=#editTag{{$j}}>
                {{$tag->name}}
            </button>
            <br>
        @endforeach
    @endforeach
</section>
@endsection