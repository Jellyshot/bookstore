<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    $aut_code = $_GET['aut_code'];
    $upload_path = './a_upload/';

    $sql = "SELECT * FROM author
    WHERE aut_code = $aut_code";
    $resultset = $conn->query($sql);
    $row = $resultset->fetch_assoc();
?>
    <article>
    <div class="b_upload">
        <img src="<?= $upload_path ?><?= $aut_upload ?>" alt="이미지 준비중입니다" style="width: 200px; height:auto;" >
    </div>
    <div class="b_info">
        <table>
            <tr><th>작가이름</th><td><?= $aut_name ?></td></tr>
            <tr><th>생년월일</th><td><?= $aut_birth ?></td></tr>
            <!-- ***** 집필작품 innerjoin으로 가져오는 방법 -->
            <tr><th>집필작품</th><td><a href="../bokk/book_detailview.php?book_code=<?= $book_code ?>"><?= $book_name ?></a></td></tr>
        </table>
    </div>
    <button onclick="history.back()">목록으로</button>
    </article>
    <article>
    <div class="b_detail">
        <table>
            <tr><th>작가 인터뷰</tr>
            <tr><td><?= $row['aut_interview'] ?></td></tr>
        </table>
    </div>
    </article>
</body>
</html> 