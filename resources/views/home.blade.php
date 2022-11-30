@extends('layouts.app')

@section('content')
<h1>タスク一覧</h1>

@if(!$phrase_exists)
<a href="{{route('create')}}">フレーズを登録しよう！</a>
@endif
@foreach($phrases as $phrase)
    <div>
        <th scope="row" style="display:inline-flex">{{$phrase['japanese']}}</th>
    </div>
        <th scope="row" style="display:inline-flex">{{$phrase['phrase']}}</th>

    <a href="detail/{{$phrase['id']}}">詳細</a>
    <a href="edit/{{$phrase['id']}}">編集</a>
    <div style="display:inline-flex">
        <form action="{{route('destroy')}}" method="post">
            @csrf
            <input type="hidden" name="phrase_id" value="{{ $phrase['id'] }}" >
            <input type="submit" value="削除">
        </form>
    </div>
@endforeach

@endsection


