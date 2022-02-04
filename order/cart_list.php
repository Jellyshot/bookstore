<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    $mem_id = $_SESSION['mem_id'];

// Group by는 cm_code에 하게 되면 해당 cm_code한개만 나오니까, 책으로 묶어야 함. 그리구 각 책 단가별 수량의 합계를 구해준 뒤 합계금액을 더한 총합계금액을 따로 계산해 주어야 합니당.

    $sql= "SELECT cs.cm_code, cs.book_code, book_name, book_price, cs_cnt, cs_rdate, book_price * cs_cnt AS price FROM cartsub AS cs
        INNER JOIN cartmain AS cm ON cs.cm_code = cm.cm_code
        INNER JOIN book AS b ON cs.book_code = b.book_code
        WHERE cm.mem_id = '".$mem_id."' GROUP BY b.book_code";
    $sql=$conn->query($sql);

?>
<h1><?= $mem_id ?>님의 장바구니</h1>
    <table>
        <tr>
            <th>장바구니번호</th>
            <th>상품내역</th>
            <th>수량</th>
            <th>단가</th>
            <th>가격</th>
            <th>담은날짜</th>
        </tr>
<?php
    $total = 0;
    while($row= $sql->fetch_array()){
        $total = $total + $row['price']
?>  
        <tr><td><?= $row['cm_code'] ?></td>
            <td><a href="../book/book_detailview.php?book_code=<?= $row['book_code'] ?>"><?= $row['book_name'] ?></a></td>
            <td><?= $row['cs_cnt'] ?></td>
            <td><?= $row['book_price'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['cs_rdate'] ?></td>
        </tr>
<?php
    }
    
?>
    </table>
    <!-- *** 이게 안먹힌 이유! : $total는 지역변수라 while문의 대괄호를 나오면 아무값이 없음! while문 밖에서 초기화 선언을 해 준후에 while문을 돌리면서 값을 더하게 한다. -->
    <p style="text-align:right; width:80%; margin:20px auto;">총 합계금액 : <?=$total?>원</p>
<?php
    $conn->close();
    $sql->close();
?>
</body>
</html>