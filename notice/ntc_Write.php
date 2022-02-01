<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

if($_SESSION['mem_id']=='admin'){
?>
<form action="./ntc_writeProcess.php" method="post" enctype="multipart/form-data" class="r_container"></form>
    <input type="text" name="ntc_subject" required>
    <input type="text" name="ntc_contents" required>
    <input type="text" name="mem_id" value="<?= $_SESSION['mem_id'] ?>" readonly>
    <input type="file" name="ntc_upload">
    <input type="submit" value="저장">
</form>
<?php
}else{
    echo "글쓰기 권한이 없습니다.";
}
?>