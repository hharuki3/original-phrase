@extends('layouts.register')

@section('javascript')
<script src="/js/confirm.js"></script>
@endsection

@section('content')
    <!-- route('store')と書くと、/storeと同義 -->

    <!-- カテゴリー削除 -->
    <form action="{{route('category_destroy')}}" method="post" id="parent">
        @csrf
    </form>

    <form action="{{route('update')}}" method="post">
        @csrf
        <input type="hidden" name="phrase_id" value="{{ $edit_phrase[0]['id'] }}">
        <input type="hidden" name="checklist" value="">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">カテゴリー</div>
                    <div class="card-body">
                        <div>
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
                                <button  name="category_id" value="{{$category['id']}}" form="parent" class="btn btn-light"  onclick="deleteHandle(event);">削除</button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Featured</div>
                    <div class="card-body">
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

                        <a href="../" class="btn btn-light">戻る</a>
                        <button type="submit" class="btn btn-light">更新</button>
                        <input type="submit"  class="btn btn-light" value="削除" form="delete"  onclick="deleteHandle(event);">

                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <form action="{{route('destroy')}}" method="post" style="display:inline-flex" id="delete">
        @csrf
        <input type="hidden" name="phrase_id" value="{{ $edit_phrase[0]['id'] }}" >
    </form>
    

@endsection
