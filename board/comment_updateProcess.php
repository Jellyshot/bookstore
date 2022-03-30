<?php
require '../utility/dbconfig.php';
require '../utility/loginchk.php';

if($chk_login){
    $cmt_code = $_POST['cmt_code'];
    $cmt_writer = $_POST['cmt_writer'];
    $bd_code = $_POST['bd_code'];
    $cmt_contents = $_POST['cmt_contents'];

    $stmt = "UPDATE bd_comment SET cmt_contents ='".$cmt_contents."' WHERE cmt_code=".$cmt_code;
    $stmt = $conn->query($stmt);

    if($stmt){
        echo outmsg(COMMENT_SUCCESS);
        $conn->close();
        
    }header('Location: ./bd_detailview.php?bd_code='.$bd_code);
}else{
?>
    <script>
        alert("로그인이 필요합니다.")
        location.href = './bd_list.php';
    </script>
<?php 
}
?>
