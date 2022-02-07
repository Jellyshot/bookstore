<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

if ($chk_login) {
?>

    <h1>쪽지쓰기</h1>
    <div class="width80">
        <hr>
        <h2>2022-02-07. 메세지 전송기능 작업중 입니다.</h2>
    </div>
    <div class="messageList" style="display: flex;">
        <div class="msgimg">
            <p style="font-size: 10rem; margin:0px 20px; color:#5abdad;" class="blinking">&#9993;</p>
        </div>
        <div class="width80">
            <form action="./msg_createProcess.php" method="POST" class="writeform">
                <input type="hidden" name="sent_mem_id" value="<?= $_SESSION['mem_id'] ?>">
                <?php
                if (isset($_GET['rec_mem_id'])) {
                // if ($_GET['rec_mem_id'] != null && $_GET['rec_mem_id'] != "") {
                    $rec_mem_id = $_GET['rec_mem_id'];
                ?> <input type="text" name="rec_mem_id" value="<?= $rec_mem_id ?>" required><br>
        <?php   } else {    ?>
                    <input type="text" name="rec_mem_id" placeholder="받는사람ID" required><br>
                <?php   }  ?>
                <textarea name="msg_contents" rows="10" required>내용을 적어주세요</textarea>
                <div class="textalign_center">
                    <input type="submit" value="전송" style="background-color:#5abdad;">
                    <input type="button" value="취소" onclick="history.back()" style=" background-color:#5abdad;">
                </div>
            </form>
        </div>
    </div>
<?php
} else {
    echo outmsg(LOGIN_NEED);
}
?>