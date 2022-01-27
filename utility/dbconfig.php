<?php

require "../utility/utility.php";

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

$conn = new mysqli($hostname, $username, $password, $dbname);

//my sqli 생성자가 리턴한 값이 null이 아니라면, 연결 설정 성공 메세지를 띄워 연결성공 및 실패를 확인함
if ($conn->connect_error) {    
    echo outmsg(DBCONN_FAIL);
    die("연결실패: ".$conn->connect_error);
}else {
    if(DBG){
        echo outmsg(DBCONN_SUCCESS);
    }
}

?>