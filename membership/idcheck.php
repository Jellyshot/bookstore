<!-- 보류 -->
<?php
require '../utility/dbconfig.php';

$mem_id = $_GET['x'];
$sql = "SELECT * FROM membership WHERE mem_id = '" . $mem_id . "'";
    $result = $conn->query($sql);
    if (!$result) {
?>
        <p style="font: size 17px;"><?= $mem_id ?>는 사용 가능한 아이디 입니다.</p>
        <input type="button" value="아이디 사용" onclick="opener.parent.decide(); window.close();">
<?php
}else {
?>
    <p style="font: size 17px;"><?= $mem_id ?>는 중복된 아이디 입니다.</p>
    <input type="text" name="id">
    <input type="submit" value="중복확인">
    <input type="button" value="취소" onclick="window.close();">
<?php
}
?>
    <script>
    alert("중복된 아이디 입니다.");
    location.href="./mem_regist.php";
    </script>