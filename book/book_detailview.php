<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    $book_code = $_GET['book_code'];
    $upload_path = './b_upload/';

    $sql = "SELECT book_code, book_name, ctg_name, b.aut_code, aut_name, pbs_name, book_info, book_price, book_pdate, book_upload FROM book AS b
    INNER JOIN author AS a ON b.aut_code = a.aut_code
    INNER JOIN publisher AS p ON b.pbs_code = p.pbs_code
    INNER JOIN category AS c ON b.ctg_code = c.ctg_code
    WHERE b.book_code = '".$book_code."'";
    
    $resultset = $conn->query($sql);
    $row = $resultset->fetch_assoc();
?>
<article>
    <div class="card">
        <img src="<?= $upload_path ?><?= $book_upload ?>" alt="이미지 준비중입니다" style="width:200px; height:300px; float:left;">
        <table style="float:left; height:300px;">
            <tr><th>도서코드</th><td><?= $row['book_code'] ?></td></tr>
            <tr><th>도서명</th><td><?= $row['book_name'] ?></td></tr>
            <tr><th>카테고리</th><td><?= $row['ctg_name'] ?></td></tr>
            <tr><th>작가명</th><td><?= $row['aut_name'] ?><a href="../author/aut_detailview.php?aut_code=<?= $row['aut_code'] ?>"> [상세보기] </a></td></tr>
            <tr><th>출판사</th><td><?= $row['pbs_name'] ?></td></tr>
            <tr><th>가격</th><td><?= $row['book_price'] ?></td></tr>
            <tr><th>출간일</th><td><?= $row['book_pdate'] ?></td></tr>
        </table>
    </div>
    <div class="buttons" style="display: flex; justify-content: center;" >
        <button onclick="history.back(-1)">목록으로</button>
        <?php
    if(isset($_SESSION['mem_id'])&&($_SESSION['mem_id']!='')){
        ?>      
        <form method="post" name="form" style="text-align: center;">
            <input type="hidden" name="book_code" value="<?=$book_code?>">
            <input type="number" name="cs_cnt" min="1" max="99" value="1">
            <input type="submit" value="장바구니" onclick="javascript: form.action='../order/cart_insert.php'" class="pointbutton" style="border:none;" >
            <input type="submit" value="구매하기" onclick="javascript: form.action='../order/orderchk.php'" class="pointbutton" style="border:none;" >
            
        </form>
     
<?php
    } ?>
    </div>
    <section class="b_dtail">
        <table>
            <tr><th>책 목차 및 내용</tr>
            <tr><td><?= $row['book_info'] ?></td></tr>
        </table>
    </section>
</article>
</body>
</html> 