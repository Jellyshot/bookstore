<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

if ($chk_login) {
?>

    <h1>쪽지함</h1>
    <div class="width80">
        <h2 style="color:#4a4737;">
            "독서는 출발이며 도착이다 "
            &nbsp;&nbsp;<테리 길리멧>
        </h2>
        <hr style="background-color: #4c3a00; height: 3px;">
    </div>
    <div class="messageList" style="display: flex;">
        <div class="msgimg">
            <p style="font-size: 10rem; margin:0px 20px; color:#5abdad;" class="blinking">&#9993;</p>
            <a href="./msg_create.php">쪽지쓰기</a>
        </div>
        <table style="margin-top: 1.5rem;">
            <tr>
                <th>보낸사람</th>
                <th>내용</th>
                <th>받은날짜</th>
                <th>답장</th>
                <th>삭제</th>
            </tr>
            <?php
            $sql = "SELECT * FROM messege WHERE rec_mem_id = '" . $_SESSION['mem_id'] . "' order by msg_rdate desc";
            $resultset = $conn->query($sql);
            if ($resultset->num_rows > 0) {
                while ($row2 = $resultset->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?= $row2['sent_mem_id'] ?></td>
                        <td><?= $row2['msg_contents'] ?></td>
                        <td><?= $row2['msg_rdate'] ?></td>
                        <td><a href="./msg_create.php?rec_mem_id=<?=$row2['sent_mem_id']?>" style="background-color:inherit; color:#5abdad; font-weight:bold; font-size:1rem;">&#9993;</a></td>
                        <td><a href="./msg_deleteProcess.php?msg_code=<?=$row2['msg_code']?>" style="background-color: inherit; color:#4c3a00; font-weight:bold; font-size:1rem;">&#9938;</a></td>
                    </tr>
                <?php   }
            } else {
                ?>
                <tr>
                    <td colspan="2"> 수신된 메세지가 없습니다. </td>
                </tr>

            <?php } ?>
        </table>
    </div>

<?php
}
?>
</body>

</html>