@extends('layouts.app')

@section('content')
    <p>ID:{{ $user->id }}</p>
    <p>開始日:{{ $user->created_at->format('Y年m月d日') }}</p>
    <p>総勉強時間:{{ $user->studyTime() }}</p>
    <p>{{ $user->profile }}</p>
@endsection