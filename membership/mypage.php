<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
?>
<section>


<!-- 자유게시판 미니보기 -->
<div class="boardlist">
    <p>내가 쓴 글</p>
    <table>
        <tr>
            <th>제목</th>
            <th>작성일</th>
        </tr>
<?php
    $stmt = $conn->query("SELECT * FROM board WHERE mem_id = ".$_SESSION['mem_id']."Limit 5 order by bd_rdate desc;");
    if ($stmt->num_rows > 0) {
        while($row = $stmt->fetch_assoc()){
?>
            <tr>
                <td><?= $row['bd_subject']?></td>
                <td><?= $row['bd_rdate'] ?></td>
            </tr>
<?php   }
    }else{
?>
        <tr> 작성한 글이 없습니다. </tr>
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
    $stmt2 = $conn->query("SELECT * FROM messege WHERE rec_mem_id = ".$_SESSION['mem_id']."Limit 3 order by msg_rdate desc;");
    if ($stmt2->num_rows > 0) {
        while($row2 = $stmt2->fetch_assoc()){
?>
            <tr>
                <td><?= $row2['sent_mem_id']?></td>
                <td><?= $row2['msg_rdate'] ?></td>
            </tr>
<?php   }
    }else{
?>
        <tr> 수신된 메세지가 없습니다. </tr>
<?php } ?>
    </table>
    <a href="../messege/msg_list.php">전체보기</a>
</div>


<!-- 구매내역 미니보기 -->

<div class="p_list"></div>
<p>구매내역</p>
    <table>
<?php
    $stmt = $conn->query("SELECT om_rdate FROM ordermain WHERE mem_id = ".$_SESSION['mem_id']."Limit 3 order by msg_rdate desc;");
    if ($stmt->num_rows > 0) {
        while($row = $stmt->fetch_assoc()){
?>
            <tr>
                <th>구매날짜</th><td>?= $row['om_rdate']?></td>
            </tr>
<?php   }
    }else{
?>
        <tr> 구매내역이 없습니다.. </tr>
<?php } ?>
    </table>
    <a href="../order/od_list.php">전체보기</a>
<div class="connect_us">
    <p>고객문의: &#9742; 070-777-7777 &#9993; jellyshot@abc.com</p>
</div>
</div>

</section>
</body>
</html>