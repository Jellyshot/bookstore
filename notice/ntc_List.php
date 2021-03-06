<?php
// 1. db연결 및 로그인 체크
require '../utility/nav.php';
require '../utility/dbconfig.php';
require_once '../utility/loginchk.php';

// 2. pagenation 사용 설정
    // 2.1 한 페이지당 들어갈 검색결과값 갯수
        $recods_per_page = 20;

    // 2.2 페이지 넘버 설정
        if (isset($_GET['page_no']) && $_GET['page_no'] !="") {
            $page_no = $_GET['page_no'];
            } else {
                $page_no = 1;
            }
    // 2.3 offset값 설정 (각 페이지의 n-1번 버튼이 시작될 값을 구함.)
        $offset = ($page_no - 1) * $recods_per_page;
    
    // 2.4. 위의 조건으로 검색 시 전체 페이지 개수 계산
        // 2.4.1 전체 레코드 검색
        $result = $conn->query("SELECT COUNT(*) AS total_recods FROM notice;");
        $total_recods = $result->fetch_array();
        $total_recods = $total_recods['total_recods'];
        // 2.4.2 전체 레코드를 페이지당 레코드 갯수로 나누어 전체 페이지 수 계산
        $total_pages = ceil($total_recods / $recods_per_page);
        // *ceil 은 나머지 항목을 고려하여 전체 페이지수를 계산하기 위한 반올림 함수이다
    // 2.5. 페이지네이션의 첫페이지, 마지막 페이지 설정
        // 2.5.2. 페이지네이션 길이 지정
        $pagination_lengh = 10;
        $start_page = floor(($page_no-1)/$pagination_lengh)*$pagination_lengh + 1;
        $end_page = $start_page + ($pagination_lengh-1);
            if ($end_page > $total_pages) {
                $end_page = $total_pages;
            }
?>

<h1>공지사항</h1>
<div class="width80">
    <h2 style="color:#4a4737;">"책은 어떤 사람에게는 울타리가 되고 어떤 사람에게는 사다리가 된다."  &nbsp;&nbsp;<레미 드 구르몽></h2>
    <hr style="background-color: #4c3a00; height: 3px;">
</div>
<div class="n_buttons">
    <!-- 관리자로 로그인시에만 보일 버튼 -->
<?php 
    if (isset($_SESSION['mem_id']) && $_SESSION['mem_id'] != '' && $_SESSION['mem_id'] == 'admin') {
?>
        <a href="./ntc_write.php">글쓰기</a>
        <a href="./ntc_write100.php">100개쓰기</a>
<?php
}  
    $sql = "SELECT * FROM notice ORDER BY ntc_code desc Limit $offset, $recods_per_page";
    $resultset = $conn->query($sql);
?>
</div>
<div class="notice_bottom">
<table>
    <tr>
        <th>No.</th>
        <th>제목</th>
        <th>작성일자</th>
    </tr>

    <!-- 쿼리구문 실행 -->
<?php
    if($resultset->num_rows >0){
        while($row = $resultset->fetch_array()){    
?>
    <tr>
    <td><?= $row['ntc_code'] ?></td>
    <td><a href="./ntc_detailview.php?ntc_code=<?= $row['ntc_code']?>"><?= $row['ntc_subject']?></a></td>
    <td><?= $row['ntc_rdate']?></td>
    <tr>
<?php
        }
?>
</table>
<div class="pagination">
<?php
    // 페이지네이션 버튼
    if($page_no >1){
        echo "<a href='ntc_list.php?page_no=1'>First</a>";
    }
    for($count = $start_page; $count <= $end_page; $count++){
        echo "<a href='ntc_list.php?page_no=".$count."'>".$count."</a>";
    }
    if($page_no < $total_pages) {
        echo "<a href = 'ntc_list.php?page_no=".$total_pages."'>Last</a>";
    }
}else{
    echo "<tr><td colspan='3';>등록된 공지사항이 없습니다</td></tr>";
}
?>
</div>
</div>
</body>
</html>