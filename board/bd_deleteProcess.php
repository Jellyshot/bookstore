<?php
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if ($chk_login) {
    
    $bd_code = $_GET['bd_code'];

    $sql = "DELETE FROM board WHERE bd_code=".$bd_code;

        if ($conn->query($sql) == TRUE) {
            echo outmsg(DELETE_SUCCESS);
        }else{
            echo outmsg(DELETE_FAIL);
        }$conn->close();

    header ('Location: ./bd_list.php');

}else{
    echo "권한이 없습니다.";
}
?>
