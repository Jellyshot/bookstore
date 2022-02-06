<?php
    // 1. db연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    // 2. 페이지네이션 구성 변수 설정

    // 페이지 넘버가 있거나, 공백이 아닐때는 그 페이지 넘버를 가져오고, 아니면 1로 지정.
    if(isset($_GET['page_no']) && $_GET['page_no']!=""){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }
    // 페이지당 보여줄 레코드 수
    $recods_per_page = 10;
    // 페이지당 뛰어넘을 레코드 갯수
    $offset = ($page_no -1) * $recods_per_page;

    // 총 레코드수를 계산하기 위한 count 쿼리 작성
    $sql = "SELECT count(*) As total_recods FROM ordermain AS b 
    ORDER BY book_code desc";

    $result = $conn->query($sql);
    $total_recods = $result->fetch_array();
    $total_recods = $total_recods['total_recods'];
    
    // 총 페이지 수를 반올림 함수 ceil을 사용하여 구하기
    $total_pages = ceil($total_recods/$recods_per_page);

    // 한 페이지당 보여줄 페이지네이션 수
    $pagination_length = 10;

    // 시작 페이지네이션 숫자
    $start_page = floor(($page_no-1)/$pagination_length)*$pagination_length +1;
    // 마지막에 올 페이지네이션 숫자
    $end_page = $start_page + ($pagination_length-1);
        if ($end_page > $total_pages) {
            $end_page = $total_pages;
        }
    // 이전 페이지로 가기
    $pre_page = $page_no-1;
    // 다음페이지로 가기
    $next_page = $page_no+1;

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
        <h1>주문관리 페이지 입니다.</h1>
        <div class="n_buttons">
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
            <th>삭제</th>
        
<?php
    // 카테고리 1값만 가져오네;;;뭐지;;;;;;??
    // 1만 가져온게 아니라, ctg_code에 맞춰서 정렬된거였음 ㅠㅠ 앞으로 innner join을 쓰면 꼭 order by 해주자!
    $sql="SELECT book_upload, book_code, book_name, ctg_name, aut_name, pbs_name, book_info, book_cost, book_price, book_pdate FROM book AS b
        INNER JOIN author AS a ON b.aut_code = a.aut_code
        INNER JOIN category AS c ON b.ctg_code = c.ctg_code
        INNER JOIN publisher AS p ON b.pbs_code = p.pbs_code
        ORDER BY book_code ASC 
        LIMIT ". $offset." ,". $pagination_length;
        
    
    $result = $conn->query($sql);

    while ($row = $result->fetch_array()) {
?>      <tr>
            <td><img src="" alt="이미지 준비중"></td>
            <td><?=$row['book_code']?></td>
            <td><a href="../book/book_update.php?book_code=<?=$row['book_code']?>"><?=$row['book_name']?></a></td>
            <td><?=$row['ctg_name']?></td>
            <td><?=$row['aut_name']?></td>
            <td><?=$row['pbs_name']?></td>
            <td><?=$row['book_info']?></td>
            <td><?=$row['book_cost']?></td>
            <td><?=$row['book_price']?></td>
            <td><?=$row['book_pdate']?></td>
            <td><a href="../book/book_deleteProcess.php?book_code=<?=$row['book_code']?>">삭제</a></td>
        </tr>     
<?php        
    }
?>
    </table>
    <div class="pagination">
<?php
//  4. Pagination 버튼 만들기
    if($page_no >1){
        echo "<a href='admin.php?page_no=1'>First</a>";
    }
    for($count = $start_page; $count <= $end_page; $count++){
        echo "<a href='admin.php?page_no=".$count."'>".$count."</a>";
    }
    if($page_no < $total_pages) {
        echo "<a href='admin.php?page_no=".$total_pages."'>Last</a>";
    }
?>
<!-- 5. 개별로 찾아 수정을 하기 위한 검색창 -->
    </div>
    <div class="search_result_container">
    <form action="./book_searchResult.php" method="GET" class="search_box">
        <select name="s_ctg">
            <option value="book_name">책이름</option>
            <option value="aut_name">작가명</option>
            <option value="pbs_name">출판사명</option>
        </select>
        <input type="text" placeholder="검색어를 입력하세요" name="search">
        <input type="submit" value="&#xf002;"/><br>
    </form>
    </div>
    </main>

<?php
    }else{
        echo "권한이 없는 페이지 입니다.";
    }
?>
</body>
</html>