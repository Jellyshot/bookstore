<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    $mem_id = $_SESSION['mem_id'];

// Group by 하면 안됨! sum도 안됨??????
    $sql= "SELECT cs.cm_code, cs.book_code, book_name, book_price, cs_cnt, cs_rdate, sum(book_price * cs_cnt) AS total_price FROM cartsub AS cs
        INNER JOIN cartmain AS cm ON cs.cm_code = cm.cm_code
        INNER JOIN book AS b ON cs.book_code = b.book_code
        WHERE cm.mem_id = '".$mem_id."' GROUP BY cm_code";
    $sql=$conn->query($sql);
    $row=0;

?>
<h1><?= $mem_id ?>님의 장바구니</h1>
    <table>
        <tr>
            <th>장바구니번호</th>
            <th>상품내역</th>
            <th>수량</th>
            <th>가격</th>
            <th>주문날짜</th>
        </tr>
<?php
    while($row= $sql->fetch_array()){
?>  
        <tr><td><?= $row['cm_code'] ?></td>
            <td><a href="../book/book_detailview.php?book_code=<?= $row['book_code'] ?>"><?= $row['book_name'] ?></a></td>
            <td><?= $row['cs_cnt'] ?></td>
            <td><?= $row['book_price'] ?></td>
            <td><?= $row['cs_rdate'] ?></td>
        </tr>
<?php
    }
?>
    </table>
    <!-- *** 이게 안먹힌 이유! : $row는 지역변수라 while문의 대괄호를 나오면 아무값이 없음! -->
    <p style="float: center;">총 합계금액 : <?=$row['total_price']?>원</p>
<?php
    $conn->close();
    $sql->close();
?>
</body>
</html>