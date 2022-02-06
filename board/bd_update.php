<!-- 자유게시판 수정 -->
<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';

$bd_code = $_GET['bd_code'];

$sql = "SELECT * FROM board WHERE bd_code = '" . $bd_code . "'";
$sql = $conn->query($sql);
$row = $sql->fetch_assoc();

if (isset($_SESSION['mem_id']) && $_SESSION['mem_id'] != '' && $_SESSION['mem_id'] == $row['mem_id']) {

echo "<h1>게시글 수정</h1>";

    if ($sql->num_rows > 0) {
?>
<div class="width80">
        <form action="./bd_updateProcess.php" method="POST" enctype="multipart/form-data" class="writeform">
                <label for="bd_code">게시글 번호</label>
                <input type="text" name="bd_code" value="<?= $bd_code ?>" /><br>

                <label for="bd_subject">제목</label>
                <input type="text" name="bd_subject" value=" <?= $row['bd_subject'] ?>" /><br>

                <label for="bd_contents">내용</label>
                <textarea name="bd_contents" rows="14" required><?= $row['bd_contents'] ?>/"></textarea><br>

                <div class="textalign_center">
                <input type="file" name="bd_upload" value="<?= $row['bd_upload'] ?>/">
                <input type="submit" value="저장">
                <a href="./bd_list.php">취소</a>
                </div>
        </form>
</div>

    <?php
    }
    $conn->close();
    $sql->close();
} else {
    ?>
    <script>
        alert("잘못된 요청입니다");
        location.href = './bd_list.php';
    </script>
<?php } ?>
</body>

</html>