<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

if ($chk_login) {
?>

    <div class="boardlist">
        <h1>내가 쓴 글</h1>
        <div class="width80">
            <h2 style="color:#4a4737;">
                "그 사람이 읽는 책을 보면 그 사람의 성격을 자연히 알 수 있다. "
                &nbsp;&nbsp;<W.차몬드>
            </h2>
            <hr style="background-color: #4c3a00; height: 3px;">
        </div>
        <table style="margin: 3rem auto;">
            <tr>
                <th>제목</th>
                <th>작성일</th>
            </tr>
            <?php


            $stmt = $conn->query("SELECT * FROM board WHERE mem_id ='" . $_SESSION['mem_id'] . "' order by bd_rdate desc;");
            if ($stmt->num_rows > 0) {
                while ($row = $stmt->fetch_assoc()) {
            ?>
                    <tr>
                        <td><a href="../board/bd_detailview.php?bd_code=<?=$row['bd_code']?>"><?= $row['bd_subject'] ?></a></td>
                        <td><?= $row['bd_rdate'] ?></td>
                    </tr>
        <?php   }
            } else {
                ?>
                <tr>
                    <td colspan="2"> 작성한 글이 없습니다. </td>
                </tr>
            <?php } ?>
        </table>
    </div>


<?php
}
?>
</body>

</html>