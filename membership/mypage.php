<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

$upload_path = './profile/';

if ($chk_login) {

    // 프로필 사진을 넣기 위한 쿼리 작성
    $sql = "SELECT * FROM membership WHERE mem_id='" . $_SESSION['mem_id'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

    <section>
        <!-- Header - set the background image for the header in the line below-->
        <div class="py-5 bg-image-full" style="background-image: url('../img/blob-scene-haikei.svg');">
            <div class="my-5" style="text-align: center;">

                <!-- 업로드된 사진이 있으면, img에 집어 넣고, 없으면 기본 이미지를 넣는 if문 작성 -->
<?php
                if (isset($row['mem_profile']) && ($row['mem_profile'] != '')) {
?>                    <img class="img-fluid rounded-circle mb-4" src="<?= $upload_path ?><?= $row['mem_profile'] ?>" alt="..." />
<?php               } else {
?>                      <img class="img-fluid rounded-circle mb-4" src="https://dummyimage.com/150x150/6c757d/dee2e6.jpg" alt="..." />
                <?php } ?>
                <h1 class="fs-3 fw-bolder"><?= $_SESSION['mem_id'] ?>님 환영합니다.</h1>
            </div>
        </div>

        <!-- Content section-->
        <div class="py-5">
            <div class="container my-5">
                <div class="row" style=" justify-content: center;">
                    <div class="col-lg-6">
                        <h2>"좋은 책을 처음 읽을 때 좋은 친구를 찾은 것과 같으며, 그 책을 다시 읽을 때는 옛 친구를 다시 만나는 것과 같다." &nbsp;&nbsp;<스미드>
                        </h2>
                    </div><br>
                </div>
                <div class="mymenu">
                    <a href="./myboard.php?mem_id=<?= $_SESSION['mem_id'] ?>">내가 쓴 글</a>
                    <a href="../messege/msg_list.php?mem_id=<?= $_SESSION['mem_id'] ?>">쪽지함</a>
                    <a href="./myorder.php?mem_id=<?= $_SESSION['mem_id'] ?>">주문내역</a>
                </div>

            </div>
            <p class="contact_us">
                고객문의 : &#9742; 070-777-7777 &nbsp;&nbsp; &#9993; jellyshot@abc.com</p>
        </div>

    <?php
} else {
    echo outmsg(LOGIN_NEED);
}
    ?>
    </body>

    </html>