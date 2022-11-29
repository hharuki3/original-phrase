@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">フレーズ詳細</div>
    <div>

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

        <a href="../">戻る</a>
        <a href="../edit/{{$edit_phrase[0]['id']}}">編集</a>

    </div>
    <form action="{{route('destroy')}}" method="post">
        @csrf
        <input type="hidden" name="phrase_id" value="{{ $edit_phrase[0]['id'] }}" >
        <input type="submit" value="削除">
    </form>
</div>
@endsection

