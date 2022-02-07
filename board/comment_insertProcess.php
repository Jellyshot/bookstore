<?php
require '../utility/dbconfig.php';
require '../utility/loginchk.php';

if($chk_login){
    $cmt_writer = $_POST['cmt_writer'];
    $bd_code = $_POST['bd_code'];
    $cmt_contents = $_POST['cmt_contents'];

    $stmt = $conn->prepare("INSERT INTO bd_comment(cmt_writer, bd_code, cmt_contents) VALUES(?,?,?)");
    $stmt->bind_param("sis", $cmt_writer, $bd_code, $cmt_contents);
    $stmt->execute();

    if($stmt){
        echo outmsg(COMMENT_SUCCESS);
        $conn->close();
        $stmt->close();
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
