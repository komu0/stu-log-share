@extends('layouts.app')
@section('content')
  @if (Auth::check())
    @include('timeline.topcard')
    <div class="tab-content">
      @include('stulogs.stulogs')
    </div>
  @else
    <div class="row text-center d-flex justify-content-center align-items-center mb-4">
        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 display-4 font-weight-bold p-4">
          Stu-Log Share
        </div>
        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 ">
            <div class="h-auto">アカウント登録して、<br>勉強の成果をシェアしよう！</div>
            {!! link_to_route('signup.get', '今すぐ新規登録(無料)', [], ['class' => 'h-auto btn btn-lg btn-primary']) !!}
        </div>
    </div>
    <ul class="nav nav-tabs mb-5">
        <li class="nav-item">
            <a href="#" class="nav-link active" data-toggle="tab">みんなのログ</a>
        </li>
    </ul>
    <div class="tab-content">
      @include('stulogs.stulogs')
    </div>
  @endif
@endsection