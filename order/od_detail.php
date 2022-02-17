<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

$om_code = $_GET['om_code'];
$upload_path = '../book/bd_upload/';

if ($chk_login) {
?>
    <h1>주문번호 <?=$om_code?> 상세보기</h1>
        <div class="width80">
            <button onclick="history.back()">뒤로가기</button>
            <hr style="background-color: #4c3a00; height: 3px;">
        <!-- </div> -->
        <table style="margin-top: 1.5rem;">
            <tr>
                <th>도서표지</th>
                <th>책이름</th>
                <th>구매수량</th>
                <th>단가</th>
                <th>금액</th>
            </tr>
<?php  
    $sql = "SELECT os.os_cnt, book_name, book_price, book_price * os_cnt AS price, book_upload FROM ordersub AS os
    INNER JOIN book AS b ON os.book_code = b.book_code
    WHERE os.om_code = '" . $om_code . "' GROUP BY om_code";
    $resultset = $conn->query($sql);

    $total_price = 0;

    if($resultset->num_rows>0){
        while($row = $resultset->fetch_array()){

            $total_price = $total_price + $row['price'];
?>
            <tr>
            <td><img src="<?=$upload_path?><?=$row['book_upload']?>" alt="이미지 준비중" style="width:100%"></td>
            <td><?= $row['book_name']?></td>
            <td><?= $row['os_cnt']?></td>
            <td><?= $row['book_price']?>원</td>
            <td><?= $row['price']?>원</td>
            </tr>
<?php
        }
    }else{
?>
    <tr><td colspan="4">구매내역이 없습니다..</td><tr>
<?php
    }
    echo "</table>";
    echo "<h2 style='text-align:right;'>총 결제금액 :".$total_price."원</h2>";
    echo "</div>";
}else{
    echo outmsg(LOGIN_NEED);
}

?>