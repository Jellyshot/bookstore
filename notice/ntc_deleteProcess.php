<?php
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if ($chk_login) {
    
    $ntc_code = $_GET['ntc_code'];

    $sql = "DELETE FROM notice WHERE ntc_code=".$ntc_code;

        if ($conn->query($sql) == TRUE) {
            echo outmsg(DELETE_SUCCESS);
        }else{
            echo outmsg(DELETE_FAIL);
        }$conn->close();

    header ('Location: ./ntc_List.php');

}else{
    echo "권한이 없습니다.";
}
?>
