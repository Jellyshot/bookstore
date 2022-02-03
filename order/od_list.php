<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    $mem_id = $_SESSION['mem_id'];

    $sql= "SELECT om_code, book_name, book_price, os_cnt, os_rdate FROM ordersub AS os
        INNER JOIN ordermain AS om ON os.om_code = om.om_code
        INNER JOIN book AS b ON os.book_name = b.book_name
            WHERE om.mem_id = ".$mem_id." GROUP BY om_code";
    $sql=$conn->query($sql);

?>
<h1><?= $mem_id ?>님의 구매내역</h1>
    <table>
        <tr>
            <th>주문번호</th>
            <th>주문내역</th>
            <th>수량</th>
            <th>가격</th>
            <th>주문날짜</th>
        </tr>
<?php
    while($row= $sql->fetch_array()){
?>  
        <tr><td><?= $row['om_code'] ?></td>
            <td><?= $row['book_name'] ?></td>
            <td><?= $row['os_cnt'] ?></td>
            <td><?= $row['book_price'] ?></td>
            <td><?= $row['os_rdate'] ?></td>
        </tr>
<?php
    }

    $conn->close();
    $sql->close();
?>
    </table>
</body>
</html>