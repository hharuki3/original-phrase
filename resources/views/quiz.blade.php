@extends('layouts.quiz')


@section('content')

<!-- ランダムだと同じ問題が複数回出題されてしまう。 
もし全ての問題が出力されたら、終了の表示をさせる-->
<h5 style="display:inline;"><a href="/home">戻る</a></h5>
<div style="display:inline;" id="UnknowCheck">
    
</div>

<h5 style="display:inline;"><a href="javascript:;" onclick="Display_JS('answer')" id = "answer">答え</a></h5>


<div>
    <div id="japanese">
        <p scope="row" style="display:inline-flex" class="japanese">{{$phrases[$randoms[0]]['japanese']}}</p>
    </div>
    <div id="phrase">
        <p scope="row" style="display:inline-flex" class="english">{{$phrases[$randoms[0]]['phrase']}}</p>
    </div>
    <div id="memo">
        <p scope="row" style="display:inline-flex" class="memo">{{$phrases[$randoms[0]]['memo']}}</p>
    </div>
</div>

<h5 style="display:inline;"><a href="javascript:;" onclick="Display_JS('Known')" id="Known">わかる</a></h5>
<h5 style="display:inline;"><a href="javascript:;" onclick="Display_JS('UnKnown')" id="UnKnown">わからない</a></h5> 
<div id="JS">
    <p>上記「切り替え」をクリックすると、ここの内容が切り替わります。</p>
</div>
<div id="UnknowCheck">
    <p>チェック</p>
</div>

<form action="{{route('quiz')}}" method="post">
    <input type="hidden" name="UnknowCheck" id="UnknowCheck">
</form>

<h5><a href="javascript:;" onclick="Display_JS('next')" id="next">次へ</a></h5> 

@endsection

@section('javascript')

<script src="{{ asset('/js/questions.js') }}"></script>
<!-- <script src="/js/questions.js"></script> -->

<script>
    const param = @json($randoms);
    let num = 0;
    console.log(param);
    let JSPhrases = @json($phrases);
    const next = document.querySelector('#next');
    next.addEventListener('click', () => {
        num = num + 1;
        console.log(param[num]);
        if (num < param.length) {
            document.getElementById("japanese").innerHTML = `<p>${JSPhrases[param[num]]['japanese']}</p>`;
            document.getElementById("phrase").innerHTML = ``;
            document.getElementById("memo").innerHTML = ``;
        } else {
            document.getElementById("JS").innerHTML = "<p>終了です。</p>";
        }
        Eelements.forEach(element => element.style.display = 'none');
        Melements.forEach(element => element.style.display = 'none');
        document.getElementById("UnknowCheck").innerHTML = '';

    });

    function Display_JS(quiz){
        if(quiz == "answer" || quiz == "Known" || quiz == "UnKnown"){
            document.getElementById("UnknowCheck").innerHTML = '<input type="checkbox" name="UnknowCheck" id="UnknowCheck">'
            document.getElementById("japanese").innerHTML = `<p>${JSPhrases[param[num]]['japanese']}</p>`;
            document.getElementById("phrase").innerHTML = `<p>${JSPhrases[param[num]]['phrase']}</p>`;
            document.getElementById("memo").innerHTML = `<p>${JSPhrases[[num]]['memo']}</p>`;
        };      
    };
</script>

</script>

<form method="post" action="{{route('update_checklist')}}" onsubmit="return checkForm(this);" id="checklist">
    @csrf
    <input type="checkbox" name="agree" id="agree">
    <input type="hidden" name="japanese" id="japanese_check">
    <input type="hidden" name="phrase" id="phrase_check">
    <input type="hidden" name="memo" id="memo_check">
    <input type="hidden" name="phrase_id" id="phrase_id_check">
    <input type="hidden" name="checklist" id="checklist_check">
    <input type="submit" value="リストに追加">
</form>


<script>

    function checkForm(form) {
        const japanese = `${JSPhrases[param[num]]['japanese']}`;
        const phrase = `${JSPhrases[param[num]]['phrase']}`;
        const memo = `${JSPhrases[param[num]]['memo']}`;
        const phrase_id = `${JSPhrases[param[num]]['id']}`;

        document.getElementById("japanese_check").value = japanese;
        document.getElementById("phrase_check").value = phrase;
        document.getElementById("memo_check").value = memo;
        document.getElementById("phrase_id_check").value = phrase_id;

        if (!form.agree.checked) {
            document.getElementById("checklist_check").value="";
            return true;
        }
            document.getElementById("checklist_check").value="checked";
            // return true;
            //こっち側しか適応されない。

    }
</script>




@endsection

<!-- チェックボックスを押すと、phraseのテーブルにあるis_existカラムにチェックがつく。
    んで、チェックがついたphraseだけ出題させる。
    テーブルに登録していく必要があるということは、postでcontroller側に値を飛ばして、そこでカラムに追加する作業が必要になる。
    postで飛ばすということは、「次」ボタンを押したら画面遷移しなければならないということになる。
    そうなるとせっかくjsで画面遷移なく次の問題に移行できたのに意味がなくなる。  
    可能ならカラムを使わずに、いや値を保持するにはデータベースに値を登録しなければならない？
    そうなると、postで送信が条件になるから、コードを書き換える必要性が出てくる。面倒臭い -->



<!-- jsの読み込みはyieldでcontentを先に読み込んだとしても
    section('javascript')はcontentの後に記述した方が良い。 -->


<!-- ElementCountの名前を適切な名前に変更
    チェックリスト機能はphraseテーブルにis_set?, is_exist?のカラムを設けて、true or falseでチェックしてるかどうかを判断
    後もう一つくらいあった気がするけどなんだったかな。
    `〇〇` この点々のなかで${}で記述したJSコードを有効にできる。
    laravelのタブを自動調整してくれる拡張機能を入れる
     -->





