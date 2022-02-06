<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

if ($chk_login) {
?>

    <div class="messegeList">
        <h1>쪽지함</h1>
        <div class="width80">
            <h2 style="color:#4a4737;">
                "독서는 출발이며 도착이다 "
                &nbsp;&nbsp;<테리 길리멧>
            </h2>
            <hr style="background-color: #4c3a00; height: 3px;">
        </div>
        <table style="margin-top: 1.5rem;">
            <tr>
                <th>보낸사람</th>
                <th>보낸날짜</th>
            </tr>
            <?php
            $stmt2 = $conn->query("SELECT * FROM messege WHERE rec_mem_id = '" . $_SESSION['mem_id'] . "' order by msg_rdate desc;");
            if ($stmt2->num_rows > 0) {
                while ($row2 = $stmt2->fetch_assoc()) {
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