@extends('layouts.register')

@section('content')
    <!-- route('store')と書くと、/storeと同義 -->
    <form action="{{route('store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">カテゴリー</div>
                    <div class="card-body">
                        <div>
                            <div>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">フレーズ</div>
                    <div class="card-body">
                        <div>
                            <div class="form-group">
                                <div>
                                    <input type="text" name="japanese" placeholder="日本語文を追加" required>
                                </div>
                                <div>
                                    <input type="text" name="phrase" placeholder="フレーズを追加" required>
                                </div>
                                
                                <textarea name="memo" rows="3" placeholder="一言メモ" required></textarea>
                            </div> 
                            
                            <a href="../" class="btn btn-light">戻る</a>
                            <button type="submit" class="btn btn-light">保存</button>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>
    </form>
        @endsection

