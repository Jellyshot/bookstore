<!-- 공지사항 상세페이지 -->
<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

$ntc_code = $_GET['ntc_code'];
$upload_path = './ntc_upload/';
?>

<h1>공지사항 상세페이지</h1>
<hr style="width: 80%; margin:auto;">
<div class="n_buttons">
    <a href="./ntc_list.php">목록으로</a>

    <?php
    if (isset($_SESSION['mem_id']) && $_SESSION['mem_id'] != '' && $_SESSION['mem_id'] == 'admin') {
    ?>
        <a href="./ntc_update.php?ntc_code=<?= $ntc_code ?>">수정</a>
        <a href="./ntc_deleteProcess.php?ntc_code=<?= $ntc_code ?>">삭제</a>
    <?php
    }
    $sql = "SELECT * FROM notice WHERE ntc_code = '" . $ntc_code . "'";
    $sql = $conn->query($sql);
    $row = $sql->fetch_assoc();
    echo "</div>";
    if ($sql->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th style="width: 20%;">제목</th>
                <td style="width: 80%;"><?= $row['ntc_subject'] ?></td>
            </tr>
            <tr>
                <td colspan="2">
<?php     if (isset($row['ntc_upload']) && ($row['ntc_upload'] != "")) {
?>
                    <img src="<?=$upload_path?><?= $row['ntc_upload'] ?>" alt="no image" style="margin: 10px;" ><br>
<?php       }       
?>                   <p style="margin: 10px;"><?= $row['ntc_contents'] ?></p>       
                </td>
            </tr>
            <tr>
                <th>첨부파일</th><td><?= $row['ntc_upload'] ?></td>
            </tr>
        </table>

    <?php
        $conn->close();
        $sql->close();
    } else {
    ?>
        <script>
            alert("잘못된 요청입니다");
            location.href = './ntc_list.php';
        </script>

    <?php
    }
    ?>
    </body>

    </html>