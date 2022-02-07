<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

// form을 바로 닫아서 submit 실행이 되지 않았었음ㅜㅜ
if($chk_login){
?>
<h1>게시글 작성</h1>
<div class="width80">
    <hr>
    <form action="./bd_writeProcess.php" method="post" enctype="multipart/form-data" class="writeform">
        <input type="hidden" name="mem_id" value="<?= $_SESSION['mem_id'] ?>" readonly><br>
        <input type="text" name="bd_subject" placeholder="제목" required><br>
        <textarea name="bd_contents" rows="16" placeholder="내용을 작성하세요" required></textarea><br>
        <input type="file" name="bd_upload"><br>
        <div class="textalign_center">
        <input type="submit" value="저장">
        <input type="button" value="취소" onclick="history.back()">
        </div>
    </form>
</div>
<?php
}else{
?>
    <script>
        alert("글쓰기 권한이 없습니다");
        location.href= "./bd_list.php";
    </script>
<?php
}
?>