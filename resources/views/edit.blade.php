@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">フレーズ編集</div>
    <!-- route('store')と書くと、/storeと同義 -->

    <!-- カテゴリー削除 -->
    <form action="{{route('category_destroy')}}" method="post" id="parent">
        @csrf
    </form>


    <form action="{{route('update')}}" method="post">
        @csrf
        <input type="hidden" name="phrase_id" value="{{ $edit_phrase[0]['id'] }}">
        <div>
            <div>
                カテゴリー
                <div>
                    <input type="text" name="new_category">
                </div>
                <input type="hidden" name="categories">
                @foreach($categories as $category)
                <div>   
                    <input type="checkbox" name="categories[]" id="{{$category['id']}}" value="{{$category['id']}}"
                    {{in_array($category['id'], $include_categories) ? 'checked' : ''}} >
                    <label for="{{$category['id']}}">{{$category['name']}}</label>
                    <!-- <input type="submit" name="categories[]" value="{{$category['id']}}" form="parent"> -->
                    <button  name="category_id" value="{{$category['id']}}" form="parent">削除</button>
                </div>
                @endforeach
            </div>
            
            <div>
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
        </div>
    </form>
    <form action="{{route('destroy')}}" method="post">
        @csrf
        <input type="hidden" name="phrase_id" value="{{ $edit_phrase[0]['id'] }}" >
        <input type="submit" value="削除">
    </form>
    

</div>
@endsection
