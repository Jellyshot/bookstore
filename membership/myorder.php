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
                <th>구매날짜</th>
                <th>구매번호</th>
            </tr>
            <tr>
                <?php
                $stmt = $conn->query("SELECT om_rdate FROM ordermain WHERE mem_id ='" . $_SESSION['mem_id'] . "' order by om_rdate desc;");
                $result = $stmt->num_rows;

                if (isset($result) && $result = '') {
                    while ($row = $stmt->fetch_assoc()) {
                ?>
                        <td>?= $row['om_rdate']?></td>
                        <td>?= $row['om_code']?></td>
                    <?php
                    }
                } else {
                    ?>
                    <td colspan="2">구매내역이 없습니다..</td>
            </tr>
        <?php
                } ?>
        </table>
        <h3 style="text-align: center;">장바구니->구매 기능 구현중입니다.</h3>
    </div>
<?php
}
?>
</body>

</html>