<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

if ($chk_login) {
?>

    <!-- 구매내역 미니보기 -->

    <div class="p_list">
    <h1>구매내역</h1>
        <div class="width80">
            <h2 style="color:#4a4737;">
                "책을 읽는데 어찌 장소를 가릴소냐? "
                &nbsp;&nbsp;<이퇴계>
            </h2>
            <button onclick="history.back()">뒤로가기</button>
            <hr style="background-color: #4c3a00; height: 3px;">
        </div>
        <table style="margin-top: 1.5rem;">
            <tr>
                <th>구매번호</th>
                <th>구매날짜</th>
            </tr>
            <?php
                $sql = $conn->query("SELECT * FROM ordermain WHERE mem_id ='".$_SESSION['mem_id']."' order by om_code desc;");
                
                
                if($sql->num_rows>0){
                    while ($row = $sql->fetch_assoc()) {
                ?>
                        <tr>
                        <td><?= $row['om_code']?></td>
                        <td><a href="../order/od_detail.php?om_code=<?= $row['om_code']?>"><?= $row['om_rdate']?></a></td>
                        </tr>
                    <?php
                    }
                }else{
                    ?>
                    <tr><td colspan="2">구매내역이 없습니다..</td><tr>
        <?php
                } ?>
        </table>
    </div>
<?php
}
?>
</body>

</html>