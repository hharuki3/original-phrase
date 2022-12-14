@extends('layouts.quiz')

@section('javascript')
<script src="/js/questions.js"></script>
@endsection


@section('content')

<!-- ランダムだと同じ問題が複数回出題されてしまう。 
もし全ての問題が出力されたら、終了の表示をさせる-->
<h5><a href="javascript:;" onclick="Display_JS('answer')">元に戻す</a></h5>
<h5><a href="javascript:;" onclick="Display_JS('question')">答え</a></h5>
<h5><a href="javascript:;" onclick="Display_JS('next')">次へ</a></h5>

<!-- $randomsという配列が渡ってくる
    0番から順番に取り出して、「次へ」ボタンを押すと1が加算。
    配列の番号が最後になったら、終了の表示をさせる
    渡ってくる配列はPHPだが、加算する際はJSを使う。
    そのため、一旦PHPからJSへ変数の受け渡しをする必要がある。 -->



<div>
    <div>
        <p scope="row" style="display:inline-flex" class="japanese">{{$phrases[]['japanese']}}</p>
    </div>
    <div>
        <p scope="row" style="display:inline-flex" class="english">{{$phrases[]['phrase']}}</p>
    </div>
    <div>
        <p scope="row" style="display:inline-flex" class="memo">{{$phrases[]['memo']}}</p>
    </div>
</div>
<p class="hello">hello</p>
 
<div id="JS">
    <p>上記「切り替え」をクリックすると、ここの内容が切り替わります。</p>
</div>

<input type="hidden" name="" value="{{$randoms_json = json_encode($randoms);}}">
<script>
    var param = JSON.parse('<?php echo $randoms_json; ?>'); 
</script>
@endsection






