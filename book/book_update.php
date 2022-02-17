<?php
    // 1. db연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    // 2. 변수 설정

    // 3. 화면 구성
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
?>
    <aside>
        <a href="./admin.php">도서관리</a>
        <a href="./manage_publisher.php">거래처관리</a>
        <a href="./manage_author.php">작가정보관리</a>
        <a href="./manage_member.php">회원관리</a>
        <a href="./manage_order.php">주문관리</a>
    </aside>
    <main>
        <h1>도서관리 페이지 입니다.</h1>
        <div class="n_buttons">
        <a href="../book/book_write.php">도서추가</a>
        </div>
        <table>
            <th style="width: 150px; height:auto">도서표지</th>
            <th>도서코드</th>
            <th>도서이름</th>
            <th>카테고리</th>
            <th>작가이름</th>
            <th>출판사명</th>
            <th>도서정보</th>
            <th>구매단가</th>
            <th>판매단가</th>
            <th>출판일</th>
            <th colspan="2">관리</th>
        
<?php
    $sql="SELECT book_upload, book_code, book_name, ctg_name, aut_name, pbs_name, book_info, book_cost, book_price, book_pdate FROM book AS b
        INNER JOIN author AS a ON b.aut_code = a.aut_code
        INNER JOIN category AS c ON b.ctg_code = c.ctg_code
        INNER JOIN publisher AS p ON b.pbs_code = p.pbs_code
        ORDER BY book_code ASC 
        LIMIT ". $offset." ,". $pagination_length;
        
    
    $result = $conn->query($sql);
    $upload_path = '../book/book_upload/';

    while ($row = $result->fetch_array()) {
?>      <tr>
            <td><img src="<?=$upload_path?><?=$row['book_upload']?>" alt="이미지 준비중"></td>
            <td><?=$row['book_code']?></td>
            <td><?=$row['book_name']?></td>
            <td><?=$row['ctg_name']?></td>
            <td><?=$row['aut_name']?></td>
            <td><?=$row['pbs_name']?></td>
            <td><?=$row['book_info']?></td>
            <td><?=$row['book_cost']?></td>
            <td><?=$row['book_price']?></td>
            <td><?=$row['book_pdate']?></td>
            <td><a href="../book/book_update.php?book_code=<?=$row['book_code']?>">수정</a></td>
            <td><a href="../book/book_deleteProcess.php?book_code=<?=$row['book_code']?>">삭제</a></td>
        </tr>     
<?php
    }
}
?>