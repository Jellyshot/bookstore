<?php
require '../utility/dbconfig.php';
require '../utility/loginchk.php';


if ($chk_login) {
    
    $mem_pwd = $_POST['mem_pwd'];
    $mem_cpwd = $_POST[['mem_cpwd']];

    if ($mem_pwd != $mem_cpwd) {
        echo outmsg(DIFF_PASSWD);
    }else {
?>

    <script>
        alert ("비밀번호가 변경되었습니다");
        location.href = "./mem_update.php?id=".$_SESSION['mem_id'];
    </script>
<?php
    }
}else{
    echo outmsg(LOGIN_NEED);
    header('Location: ./mem_login.php');
}

?>