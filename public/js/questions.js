// 次の問題へ進むボタンを押して、全ての配列が出力されたら終了の表示
// 登録してあるphraseの個数を配列に格納。→ランダムに出力（重複なし）→else文で終了を出力

const checkbox = document.querySelector('#checkbox');
const button = document.querySelector('#button');
// チェックボックスがクリックされたときの処理
//<p>タグであれば非表示にできるが<th>タグだと効果がない。なぜ？
checkbox.addEventListener('click', () => {
  // 非同期処理を開始する
  setTimeout(() => {    
    // HTML内の「english」クラスを持つ要素を取得する
    const elements = document.querySelectorAll('.english');
    console.log(elements);
    if(checkbox.checked){
        elements.forEach(element => element.style.display = 'none');

    }else{
        elements.forEach(element => element.style.display = '');
    }
    // 取得した要素をすべて非表示にする
  }, 0);
});