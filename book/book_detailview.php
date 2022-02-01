<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    $book_code = $_GET['book_code'];
    $upload_path = './b_upload/';

    $sql = "SELECT book_code, book_name, ctg_name, aut_code, aut_name, pbs_name, book_info, book_price, book_pdate, book_upload FROM book AS b
    INNER JOIN author AS a ON b.aut_code = a.aut_code
    INNER JOIN publisher AS p ON b.pbs_code = p.pbs_code
    INNER JOIN category AS c ON b.ctg_code = c.ctg_code
    WHERE book_code = $book_code";
    $resultset = $conn->query($sql);
    $row = $resultset->fetch_assoc();
?>
    <article>
    <div class="b_upload">
        <img src="<?= $upload_path ?><?= $book_upload ?>" alt="이미지 준비중입니다" style="width: 200px; height:auto;" >
    </div>
    <div class="b_info">
        <table>
            <tr><th>도서코드</th><td><?= $book_code ?></td></tr>
            <tr><th>도서명</th><td><?= $book_name ?></td></tr>
            <tr><th>카테고리</th><td><?= $ctg_name ?></td></tr>
            <tr><th>작가명</th><td><a href="../author/aut_detailview.php?aut_code=<?= $aut_code ?>"><?= $aut_name ?></a></td></tr>
            <tr><th>출판사</th><td><?= $pbs_name ?></td></tr>
            <tr><th>가격</th><td><?= $book_price ?></td></tr>
            <tr><th>출간일</th><td><?= $book_pdate ?></td></tr>
        </table>
    </div>
    <button onclick="history.back()">목록으로</button>
    </article>
    <article>
    <div class="b_detail">
        <table>
            <tr><th>책 목차 및 내용</tr>
            <tr><td><?= $row['book_info'] ?></td></tr>
        </table>
    </div>
    </article>
</body>
</html> 