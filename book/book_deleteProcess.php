<?php
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if ($chk_login) {
    
    $book_code = $_GET['book_code'];

    $sql = "DELETE FROM book WHERE book_code=".$book_code;

        if ($conn->query($sql) == TRUE) {
            echo outmsg(DELETE_SUCCESS);
        }else{
            echo outmsg(DELETE_FAIL);
        }$conn->close();

    header ('Location: ../manage/admin.php');

}else{
    echo "권한이 없습니다.";
}
?>
