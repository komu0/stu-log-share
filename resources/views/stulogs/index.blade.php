@extends('layouts.app')
@section('content')
  @if (Auth::check())
    <div class="mb-4">
      <p>{{ $user->id }}</p>
      <p>followings:{{ $user->followings_count }}</p>
      <p>followers:{{ $user->followers_count }}</p>
      <a href="#">ログを投稿</a>
    </div>
    <ul class="nav nav-tabs mb-5">
        <li class="nav-item">
            <a href="minLogs" class="nav-link active" data-toggle="tab">みんなのログ</a>
        </li>
    </ul>
    <div class="tab-content">
      @include('stulogs.stulogs')
    </div>
  @else
    <div class="row text-center d-flex align-items-center mb-4">
        <div class="offset-md-2 col-md-4 display-4 font-weight-bold p-4">Stu-Log Share</div>
        <div class="col-md-4">
            <div class="h-auto">アカウント登録して、<br>勉強の成果をシェアしよう！</div>
            {!! link_to_route('signup.get', '今すぐ新規登録(無料)', [], ['class' => 'h-auto btn btn-lg btn-primary']) !!}
        </div>
    </div>
    <ul class="nav nav-tabs mb-5">
        <li class="nav-item">
            <a href="minLogs" class="nav-link active" data-toggle="tab">みんなのログ</a>
        </li>
    </ul>
    <div class="tab-content">
      @include('stulogs.stulogs')
    </div>
  @endif
@endsection