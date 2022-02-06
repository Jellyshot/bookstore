<!-- 공지사항 상세페이지 -->
<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

$bd_code = $_GET['bd_code'];
$upload_path = './bd_upload/';

$sql = "SELECT * FROM board WHERE bd_code = $bd_code";
$sql = $conn->query($sql);
$row = $sql->fetch_assoc();
?>

<h1>자유게시판 상세페이지</h1>
<hr style="width: 80%; margin:auto;">
<div class="n_buttons">
    <a href="./bd_list.php">목록으로</a>
    <?php
    if (isset($_SESSION['mem_id']) && $_SESSION['mem_id'] != '' && $_SESSION['mem_id'] == $row['mem_id']) {
    ?>
        <a href="./bd_update.php?bd_code=$bd_code">수정</a>
        <a href="./bd_deleteProcess.php?bd_code=$bd_code">삭제</a>
    <?php
    }
    echo "</div>";

    if ($sql->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th style="width: 20%;">제목</th>
                <td style="width: 80%;"><?= $row['bd_subject'] ?></td>
            </tr>
            <tr>
                <th style="width: 20%;">작성자</th>
                <td style="width: 80%;"><?= $row['mem_id'] ?></td>
            </tr>
            <tr>
                <td colspan="2">
    
<?php     if (isset($row['bd_upload']) && ($row['bd_upload'] != "")) {
?>
                    <img src="<?=$upload_path?><?= $row['bd_upload'] ?>" alt="no image" style="margin: 10px;" ><br>
<?php       }       
?>                   <p style="margin: 10px;"><?= $row['bd_contents'] ?></p>
                </td>
            </tr>
            <tr>
                <th>첨부파일</th><td><?= $row['bd_upload'] ?></td>
            </tr>
        </table>

    <?php
        $conn->close();
        $sql->close();
    } else {
    ?>
        <script>
            alert("잘못된 요청입니다");
            location.href = './bd_list.php';
        </script>

    <?php
    }
    ?>
    </body>

    </html>