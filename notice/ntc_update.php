<!-- 공지사항 수정 -->
<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';

$ntc_code = $_GET['ntc_code'];

$sql = "SELECT * FROM notice WHERE ntc_code = $ntc_code";
$sql = $conn->query($sql);
$row= $sql->fetch_assoc();

echo "<h1>공지사항 상세페이지</h1>";
if($sql->num_rows >0){
?>
<form action="./ntc_updateProcess.php">
    <div class="n_update">
    <label for="ntc_code">공지사항 번호</label>
    <input type="text" name="ntc_code" value="<?= $ntc_code ?>" /><br>
    <label for="ntc_subject">제목</label>
    <input type="text" name="ntc_subject" value=" <?= $row['ntc_subject']?>"/><br>
    <label for="ntc_contents">내용</label>
    <input type="text" name="ntc_contents" value="<?= $row['ntc_contents'] ?>/"><br>
    <label for="ntc_upload">첨부파일</label>
    <input type="file" name="ntc_upload" value="<?= $row['ntc_upload']?>/">
    </div>
    <div class="n_buttons">
        <input type="submit" value="저장">
        <a href="./ntc_list.php">취소</a>
    </div>
</form>

<?php
} 
    $conn->close();
    $sql->close();
?>
<script> 
    alert("잘못된 요청입니다");
    location.href = './ntc_list.php';
</script>
</body>
</html>