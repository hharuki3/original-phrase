@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">フレーズ登録</div>
    <!-- route('store')と書くと、/storeと同義 -->
    <form action="{{route('store')}}" method="post">
        @csrf
        <div>
            <div>
                カテゴリー
                <div>
                    <input type="text" name="new_category" placeholder="カテゴリーを追加">
                </div>
                @foreach($categories as $category)
                <div>
                    <input type="checkbox" name="categories[]" id="{{$category['id']}}" value="{{$category['id']}}">
                    <label for="{{$category['id']}}">{{$category['name']}}</label>
                </div>
                @endforeach
            </div>

            <div class="form-group">
                フレーズ
                <div>
                    <input type="text" name="japanese" placeholder="日本語文を追加" required>
                </div>
                <div>
                    <input type="text" name="phrase" placeholder="フレーズを追加" required>
                </div>
                
                <textarea name="memo" rows="3" placeholder="一言メモ" required></textarea>
            </div> 

            <a href="../">戻る</a>
            <button type="submit" class="btn btn-primary">保存</button>

        </div>
    </form>
</div>
@endsection

