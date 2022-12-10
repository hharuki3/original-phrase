@extends('layouts.auth')
@section('name')
    フレーズ詳細
@endsection
@section('content')
<div class="card">
    <div class="card-header">フレーズ詳細</div>
    <div class="form-group">
        フレーズ
        <div>
            {{$edit_phrase[0]['japanese']}}
        </div>
        <div>
            {{$edit_phrase[0]['phrase']}}
        </div>
        {{$edit_phrase[0]['memo']}}
    </div> 
    <div>
        <a href="../" class="btn btn-light">戻る</a>
        <a href="../edit/{{$edit_phrase[0]['id']}}" class="btn btn-light">編集</a>
        <form action="{{route('destroy')}}" method="post" style="display:inline-flex">
            @csrf
            <input type="hidden" name="phrase_id" value="{{ $edit_phrase[0]['id'] }}" >
            <button type="button" class="btn btn-light">削除</button>
        </form>
    </div>
</div>
@endsection

