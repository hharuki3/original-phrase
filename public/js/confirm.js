function deleteHandle(event){
    // dd('来てるよ');
    event.preventDefault();
    if(window.confirm('本当に削除していいですか？')){
        document.getElementById('delete-form').submit();
    }else{
        alert('キャンセルしました');
    }
}

