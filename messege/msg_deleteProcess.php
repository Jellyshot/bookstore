<?php
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if ($chk_login) {
    
    $msg_code = $_GET['msg_code'];

    $sql = "DELETE FROM messege WHERE msg_code=".$msg_code;

        if ($conn->query($sql) == TRUE) {
            echo outmsg(DELETE_SUCCESS);
        }else{
            echo outmsg(DELETE_FAIL);
        }$conn->close();

    header ('Location: ./msg_list.php');

}else{
    echo "권한이 없습니다.";
}
?>
