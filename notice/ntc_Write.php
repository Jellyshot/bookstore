<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

// 공지사항이 안써짐 ㅠㅠ 
if($_SESSION['mem_id'] =='admin'){
?>
<h1>공지사항 작성</h1>
<div class="width80">
    <hr>
    <form action="./ntc_writeProcess.php" method="post" enctype="multipart/form-data" class="writeform">
        <input type="hidden" name="mem_id" value="<?= $_SESSION['mem_id'] ?>" readonly><br>
        <input type="text" name="ntc_subject" placeholder="제목" required><br>
        <textarea name="ntc_contents" rows="16" placeholder="내용을 작성하세요" required></textarea><br>
        <input type="file" name="ntc_upload"><br>
        <input type="submit" value="저장">
    </form>
</div>

<?php
}else{
    echo "<script>alert('글쓰기 권한이 없습니다'); location.href='./ntc_list.php';</script>";
}
?>