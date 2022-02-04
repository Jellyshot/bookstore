<!-- 자유게시판 수정 -->
<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';

$bd_code = $_GET['bd_code'];

$sql = "SELECT * FROM board WHERE bd_code = $bd_code";
$sql = $conn->query($sql);
$row= $sql->fetch_assoc();

echo "<h1>공지사항 상세페이지</h1>";
if($sql->num_rows >0){
?>
<form action="./bd_updateProcess.php">
    <div class="n_update">
    <label for="bd_code">공지사항 번호</label>
    <input type="text" name="bd_code" value="<?= $bd_code ?>" /><br>
    <label for="bd_subject">제목</label>
    <input type="text" name="bd_subject" value=" <?= $row['bd_subject']?>"/><br>
    <label for="bd_contents">내용</label>
    <input type="text" name="bd_contents" value="<?= $row['bd_contents'] ?>/"><br>
    <label for="ntc_upload">첨부파일</label>
    <input type="file" name="bd_upload" value="<?= $row['bd_upload']?>/">
    </div>
    <div class="n_buttons">
        <input type="submit" value="저장">
        <a href="./bd_list.php">취소</a>
    </div>
</form>

<?php
} 
    $conn->close();
    $sql->close();
?>
<script> 
    alert("잘못된 요청입니다");
    location.href = './bd_list.php';
</script>
</body>
</html>