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
    $sql = "SELECT count(*) AS total_recods FROM ordermain";


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
        <h1>주문내역 확인 페이지 입니다.</h1>
        
        <table>
            <th>회원ID</th>
            <th>주문번호</th>
            <th>주문일자</th>
            <th>책코드</th>
            <th>책이름</th>
            <th>구매수량</th>
            <th>판매단가</th>
        
<?php
    
    $sql="SELECT om.om_code, mem_id, om_rdate, os.book_code, book_name, os_cnt, book_price  FROM ordermain AS om
    INNER JOIN ordersub AS os ON om.om_code = os.om_code
    INNER JOIN book AS b ON b.book_code = os.book_code
    ORDER BY om.om_code DESC ,os.os_code DESC
        LIMIT ". $offset." ,". $pagination_length;
        
    
    $result = $conn->query($sql);

    while ($row = $result->fetch_array()) {
?>      <tr>
            <td><?=$row['mem_id']?></td>
            <td><?=$row['om_code']?></td>
            <td><?=$row['om_rdate']?></td>
            <td><?=$row['book_code']?></td>
            <td><?=$row['book_name']?></td>
            <td><?=$row['os_cnt']?></td>
            <td><?=$row['book_price']?></td>
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
    </div>
    </main>

<?php
    }else{
        echo "권한이 없는 페이지 입니다.";
    }
?>
</body>
</html>