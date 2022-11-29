@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">フレーズ編集</div>
    <!-- route('store')と書くと、/storeと同義 -->
    <form action="{{route('update')}}" method="post">
        @csrf
        <input type="hidden" name="phrase_id" value="{{ $edit_phrase[0]['id'] }}">
        <div>
            <div>
                カテゴリー
                <div>
                    <input type="text" name="new_category" >
                </div>
                @foreach($categories as $category)
                <div>
                    <input type="checkbox" name="categories[]" id="{{$category['id']}}" value="{{$category['id']}}"
                    {{in_array($category['id'], $include_categories) ? 'checked' : ''}}>
                    <label for="{{$category['id']}}">{{$category['name']}}</label>
                </div>
                @endforeach
            </div>

            <div class="form-group">
                フレーズ
                <div>
                    <input type="text" name="japanese" value="{{$edit_phrase[0]['japanese']}}">
                </div>
                <div>
                    <input type="text" name="phrase" value="{{$edit_phrase[0]['phrase']}}">
                </div>
                
                <textarea name="memo" rows="3">{{$edit_phrase[0]['memo']}}</textarea>
            </div> 

            <a href="../">戻る</a>
            <button type="submit" class="btn btn-primary">更新</button>

        </div>
    </form>
    <form action="{{route('destroy')}}" method="post">
        @csrf
        <input type="hidden" name="phrase_id" value="{{ $edit_phrase[0]['id'] }}" >
        <input type="submit" value="削除">
    </form>
</div>
@endsection
