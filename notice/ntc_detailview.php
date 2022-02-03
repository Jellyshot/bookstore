<!-- 공지사항 상세페이지 -->
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
<div class="n_buttons">
    <a href="./ntc_list.php">목록으로</a>
    <a href="./ntc_update.php?ntc_code=$ntc_code">수정</a>
    <a href="./ntc_deleteProcess.php?ntc_code=$ntc_code">삭제</a>
</div>
    <table>
        <tr><th>제목</th><td><?= $row['ntc_subject'] ?></td></tr>
        <tr><th colspan="2">상세내용</th></tr>
        <tr><th colspan="2"><?= $row['ntc_contents'] ?></th></tr>
    </table>
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