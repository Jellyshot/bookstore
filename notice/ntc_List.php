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
        $offset = ($pageNo - 1) * $recods_per_page;
    
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
        
?>

<div class="notice_top">
<h1>공지사항</h1>
<!-- 관리자로 로그인시에만 보일 버튼 -->
<?php 
if ($_SESSION['m_id'] == 'admin') {
?>
    <button><a href="./noticeWrite.php">글쓰기</a></button>
<?php
}   $sql = "SELECT * FROM notice Limit $offset, $recods_per_page";
    $resultset = $conn->query();
    
?>
</div>
<div class="notice_bottom">
<table>
    <tr>
        <td>No.</td>
        <td>제목</td>
        <td>작성일자</td>
    </tr>

    <!-- 쿼리구문 실행 -->
    <tr>
        <td><?= ?></td>
        <td><?= ?></td>
        <td><?= ?></td>
    </tr>
</table>
</div>
    