<?php
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if ($chk_login) {
    
    $mem_id = $_GET['mem_id'];

    $sql = "DELETE FROM membership WHERE mem_id='".$mem_id."'";

        if ($conn->query($sql) == TRUE) {
            echo outmsg(DELETE_SUCCESS);
        }else{
            echo outmsg(DELETE_FAIL);
        }$conn->close();

    header ('Location: ../manage/manage_member.php');

}else{
    echo "권한이 없습니다.";
}
?>
