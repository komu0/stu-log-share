@extends('layouts.app')
@section('content')
<h1>{{ $user->id }}さんの分析ページ</h1>
<h2>総勉強時間</h2>
<h3>{{$user->study_time()}}</h3>
@endsection
