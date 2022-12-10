@extends('layouts.quiz')

@section('javascript')
<script src="/js/questions.js"></script>
@endsection


@section('content')
<!-- 配列を受け取って、javascriptのランダム関数で一つだけ取得。
受け取った配列の日本語、英語、メモを表示させたい。
phraseのid番号は関係ない。
phraseの「登録数-1」が分かればそれを配列に格納すればよい。 
そもそも配列に格納する必要はあるのか、数さえわかれば良いのだから。-->


<!-- ランダムだと同じ問題が複数回出題されてしまう。 
もし全ての問題が出力されたら、終了の表示をさせる-->
<input type="checkbox" name="checkbox" id="checkbox">
<label for="checkbox">英語文を非表示にする</label>
<div>
    <div>
        <p scope="row" style="display:inline-flex" class="japanese">{{$phrases[$randoms]['japanese']}}</p>
    </div>
    <div>
        <p scope="row" style="display:inline-flex" class="english">{{$phrases[$randoms]['phrase']}}</p>
    </div>
</div>

@endsection





