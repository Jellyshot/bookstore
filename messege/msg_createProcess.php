<?php
require '../utility/dbconfig.php';
require '../utility/loginchk.php';

if ($chk_login) {
    $sent_mem_id = $_POST['sent_mem_id'];
    $rec_mem_id = $_POST['rec_mem_id'];
    $msg_contents = $_POST['msg_contents'];

    $sql = $conn->prepare("INSERT INTO messege(sent_mem_id, rec_mem_id, msg_contents) VALUES (?,?,?)");
    $sql->bind_param("sss", $sent_mem_id, $rec_mem_id, $msg_contents);
    $sql->execute();

    if($sql){
        echo "메세지가 전송되었습니다";
        $conn->close();
        $sql->close();
    }header('Location: ../messege/msg_list.php')

?>

<?php
}else{
    echo outmsg(LOGIN_NEED);
}
?>