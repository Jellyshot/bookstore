<?php
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if ($chk_login) {
    
    $cmt_code = $_GET['cmt_code'];
    $bd_code = $_GET['bd_code'];

    $sql = "DELETE FROM bd_comment WHERE cmt_code=".$cmt_code;

        if ($conn->query($sql) == TRUE) {
            echo outmsg(DELETE_SUCCESS);
        }else{
            echo outmsg(DELETE_FAIL);
        }$conn->close();

    header ('Location:./bd_detailview.php?bd_code='.$bd_code);

}else{
    echo "권한이 없습니다.";
}
?>
