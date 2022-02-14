<?php
    require  '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if($chk_login == TRUE && $_SESSION['mem_id'] =='admin'){
        
        $aut_code = $_GET['aut_code'];

        $sql = "DELETE FROM author WHERE aut_code=".$aut_code;

        if ($conn->query($sql) == TRUE) {
            echo outmsg(DELETE_SUCCESS);
        }else{
            echo outmsg(DELETE_FAIL);
        }$conn->close();
        header ('Location:../manage/manage_author.php');
    }else{
        echo "권한이 없습니다.";
    }
?>