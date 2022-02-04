<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

// form을 바로 닫아서 submit 실행이 되지 않았었음ㅜㅜ
if($_SESSION['mem_id'] =='admin'){
?>
    <form action="./bd_writeProcess.php" method="post" enctype="multipart/form-data" class="r_container">
        <input type="text" name="mem_id" value="<?= $_SESSION['mem_id'] ?>" readonly><br>
        <input type="text" name="bd_subject" placeholder="제목" required><br>
        <textarea name="bd_contents" cols="30" rows="10" placeholder="내용" required></textarea><br>
        <input type="file" name="bd_upload"><br>
        <input type="submit" value="저장">
    </form>
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