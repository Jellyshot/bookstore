
function checkid() {
    let x = document.getElementById('mem_id').value;

    if (x) {
        URL = '../membership/idcheck.php?id='+x;
        window.open(URL,"아이디체크","width=400,height=200");
    }else{
        alert("아이디를 입력하세요.");
        window.close();
    }
}

