@extends('layouts.app')

@section('name')
    カテゴリー
@endsection

@section('javascript')
<script src="/js/confirm.js"></script>
<script src="/js/display.js"></script>
@endsection


@section('item')
<div class="row">
    <div class="col-md-2">
        <div>
            <a href="/" class="btn btn-light">
            <img width="30" src="{{asset('img/group.png')}}" alt="">
            </a>
        </div>
        <div>
            <a href="{{route('quiz')}}" class="btn btn-light">
                <img width="30" src="{{asset('img/group.png')}}" alt="">
            </a>
        </div>
        <div>
            <a href="{{route('group')}}" class="btn btn-light">
                <img width="30" src="{{asset('img/group.png')}}" alt="">
            </a>
        </div>
    </div>
    <div class="col-md-9">
        <a href="/category" class="btn btn-light">全て表示</a>
        @foreach($categories as $category)
        <div>
            <a href="/category/?category={{$category['id']}}" class="btn btn-light">
                <span>{{$category['name']}}</span>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection


@section('content')
<input type="checkbox" name="checkbox" id="checkbox">
<label for="checkbox">英語文を非表示にする</label>
@foreach($phrases as $phrase)
    <div>
        <th scope="row" style="display:inline-flex">{{$phrase['japanese']}}</th>
    </div>
    <div>
        <p scope="row" style="display:inline-flex" class="english">{{$phrase['phrase']}}</p>
    </div>
    <a href="detail/{{$phrase['id']}}" class="btn btn-light">詳細</a>
    <a href="edit/{{$phrase['id']}}" class="btn btn-light">編集</a>
    <div style="display:inline-flex">
        <form action="{{route('destroy')}}" method="post" id="delete-form">
            @csrf
            <input type="hidden" name="phrase_id" value="{{ $phrase['id'] }}" >
            <button type="submit" class="btn btn-light" onclick="deleteHandle(event);">削除</button>
        </form>
    </div>
@endforeach

@endsection


