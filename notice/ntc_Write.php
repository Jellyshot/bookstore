<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

    // 공지사항이 안써짐 ㅠㅠ 
if($_SESSION['mem_id'] =='admin'){
?>
<form action="./ntc_writeProcess.php" method="post" enctype="multipart/form-data" class="r_container"></form>
    <input type="text" name="ntc_subject" placeholder="제목" required><br>
    <textarea name="ntc_contents" cols="30" rows="10" placeholder="내용" required></textarea><br>
    <input type="text" name="mem_id" value="<?= $_SESSION['mem_id'] ?>" readonly><br>
    <input type="file" name="ntc_upload"><br>
    <input type="submit" value="저장">
</form>
<!-- form 저장이 안됨! 'admin'으로 로그인 했는데! -->
<?php
}else{
    echo "글쓰기 권한이 없습니다.";
}
?>