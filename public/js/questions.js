// 次の問題へ進むボタンを押して、全ての配列が出力されたら終了の表示
// 登録してあるphraseの個数を配列に格納。→ランダムに出力（重複なし）→else文で終了を出力

const Eelements = document.querySelectorAll('.english');
const Melements = document.querySelectorAll('.memo');

console.log(param);


Eelements.forEach(element => element.style.display = 'none');
Melements.forEach(element => element.style.display = 'none');

num = 0;
// チェックボックスがクリックされたときの処理
//<p>タグであれば非表示にできるが<th>タグだと効果がない。なぜ？

function Display_JS(quiz){

  if(quiz == "question"){

    document.getElementById("JS").innerHTML = "<p>「元に戻す」をクリックすると元に戻ります。</p>";
    Eelements.forEach(element => element.style.display = '');
    Melements.forEach(element => element.style.display = '');

  }else if(quiz == "answer"){
    document.getElementById("JS").innerHTML = "<p>上記「切り替え」をクリックすると、ここの内容が切り替わります。</p>";
    Eelements.forEach(element => element.style.display = 'none');
    Melements.forEach(element => element.style.display = 'none');
    
  }else if(quiz == "next"){

    if(num < param.length){
      element_count = num;
      num = num + 1;
    }else{
      console.log('終了');
    }
    
    document.getElementById("JS").innerHTML = "<p>次の問題です。</p>";
    Eelements.forEach(element => element.style.display = 'none');
    Melements.forEach(element => element.style.display = 'none');
    Relements.forEach(element => element.style.display = 'none');


  }
}



