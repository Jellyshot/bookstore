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
                <th>보낸날짜</th>
            </tr>
            <?php
            $sql = "SELECT * FROM messege WHERE rec_mem_id = '" . $_SESSION['mem_id'] . "' order by msg_rdate desc";
            $resultset = $conn->query($sql);
            if ($resultset->num_rows > 0) {
                while ($row2 = $resultset->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?= $row2['sent_mem_id'] ?></td>
                        <td><?= $row2['msg_rdate'] ?></td>
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