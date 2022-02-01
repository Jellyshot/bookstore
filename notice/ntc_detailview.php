<!-- 공지사항 상세페이지 -->
<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';

$ntc_code = $_GET['ntc_code'];

$sql = "SELECT * FROM notice WHERE ntc_code = $ntc_code";
$sql = $conn->query($sql);
$row= $sql->fetch_assoc();

echo "<h1>공지사항 상세페이지</h1>";
echo "<a href='./ntc_list'>목록으로</a>";

if($sql->num_rows >0){
?>
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