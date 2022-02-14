<?php
    require  '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if($chk_login == TRUE && $_SESSION['mem_id'] =='admin'){
        
        $pbs_code = $_GET['pbs_code'];

        $sql = "DELETE FROM publisher WHERE pbs_code=".$pbs_code;

        if ($conn->query($sql) == TRUE) {
            echo outmsg(DELETE_SUCCESS);
        }else{
            echo outmsg(DELETE_FAIL);
        }$conn->close();
        header ('Location:../manage/manage_publisher.php');
    }else{
        echo "권한이 없습니다.";
    }
?>