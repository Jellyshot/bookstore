<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

$upload_path = './profile/';

if ($chk_login) {

    // 프로필 사진을 넣기 위한 쿼리 작성
    $sql = "SELECT * FROM membership WHERE mem_id='".$_SESSION['mem_id']."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>

    <section>
        <!-- Header - set the background image for the header in the line below-->
        <div class="py-5 bg-image-full" style="background-image: url('../img/blob-scene-haikei.svg');">
            <div class="my-5" style="text-align: center;">

                <!-- 업로드된 사진이 있으면, img에 집어 넣고, 없으면 기본 이미지를 넣는 if문 작성 -->
                <?php
                if (isset($row['mem_upload'])&&($row['mem_upload']!='')) {
        ?>
                    <img class="img-fluid rounded-circle mb-4" src="<?=$upload_path?><?=$row['mem_profile']?>" alt="..." />
        <?php      
                } else {
        ?>
                    <img class="img-fluid rounded-circle mb-4" src="https://dummyimage.com/150x150/6c757d/dee2e6.jpg" alt="..." />
                <?php } ?>

                <h1 class="fs-3 fw-bolder"><?=$_SESSION['mem_id']?>님 환영합니다.</h1>
            </div>
        </div>
        
        <!-- Content section-->
        <div class="py-5">
            <div class="container my-5">
                <div class="row" style=" justify-content: center;">
                    <div class="col-lg-6">
                        <h2>Full Width Pics</h2>
                        <p class="lead">우리가 좋은 책을 처음 읽을 때 좋은 친구를 찾은 것과 같으며, 그 책을 다시 읽을 때는 옛 친구를 다시 만나는 것과 같다.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- 자유게시판 미니보기 -->
        <div class="boardlist">
            <p>내가 쓴 글</p>
            <table>
                <tr>
                    <th>제목</th>
                    <th>작성일</th>
                </tr>
                <?php

                
                $stmt = $conn->query("SELECT * FROM board WHERE mem_id ='".$_SESSION['mem_id']."' order by bd_rdate desc LIMIT 5;");
                if ($stmt->num_rows > 0) {
                    while ($row = $stmt->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?= $row['bd_subject'] ?></td>
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
            <a href="../board/bd_list.php">전체보기</a>
        </div>


        <div class="right_section">

            <!-- 메세지 미니보기 -->
            <div class="messegeList">
                <p>쪽지함</p>
                <table>
                    <tr>
                        <th>보낸사람</th>
                        <th>보낸날짜</th>
                    </tr>
                    <?php
                    $stmt2 = $conn->query("SELECT * FROM messege WHERE rec_mem_id = '".$_SESSION['mem_id']."' order by msg_rdate desc limit 3;");
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
                <a href="../messege/msg_list.php">전체보기</a>
            </div>


            <!-- 구매내역 미니보기 -->

            <div class="p_list"></div>
            <p>구매내역</p>
            <table>
                <tr>
                    <th>구매날짜</th><th>구매번호</th>
                </tr>
                <tr>
                <?php
                $stmt = $conn->query("SELECT om_rdate FROM ordermain WHERE mem_id ='".$_SESSION['mem_id']."' order by msg_rdate desc LIMIT 3;");
                $result = $stmt->num_rows;

                if (isset($result)&&$result='') {  
                    while ($row = $stmt->fetch_assoc()) {
                ?>
                            <td>?= $row['om_rdate']?></td>
                            <td>?= $row['om_code']?></td>
<?php  
                    }
                }else {
?>                      
                    <td>구매내역이 없습니다..</td>
                </tr>
<?php 
} ?>
            </table>
            <a href="../order/od_list.php">전체보기</a>
            <div class="connect_us">
                <p>고객문의: &#9742; 070-777-7777 &#9993; jellyshot@abc.com</p>
            </div>
        </div>

    </section>
<?php
    }
?>
</body>

</html>