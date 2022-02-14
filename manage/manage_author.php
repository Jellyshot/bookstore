<?php
    // 1. db연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    // 2. 페이지네이션 구성 변수 설정
    if(isset($_GET['page_no']) && $_GET['page_no']!=""){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }
    $recods_per_page = 10;
    $offset = ($page_no -1) * $recods_per_page;

    $sql = "SELECT count(*) As total_recods FROM author
    ORDER BY aut_code desc";

    $result = $conn->query($sql);
    $total_recods = $result->fetch_array();
    $total_recods = $total_recods['total_recods'];
    
    $total_pages = ceil($total_recods/$recods_per_page);

    $pagination_length = 10;

    $start_page = floor(($page_no-1)/$pagination_length)*$pagination_length +1;
    $end_page = $start_page + ($pagination_length-1);
        if ($end_page > $total_pages) {
            $end_page = $total_pages;
        }
    $pre_page = $page_no-1;
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
        <h1>작가관리 페이지 입니다.</h1>
        <div class="n_buttons">
        <a href="../author/aut_insert.php">작가추가</a>
        </div>
        <table>
            <th>작가코드</th>
            <th>작가사진</th>
            <th>작가이름</th>
            <th>인터뷰내용</th>
            <th>생년월일</th>
            <th colspan="2">관리</th>
        
<?php
    // 카테고리 1값만 가져오네;;;뭐지;;;;;;??
    // 1만 가져온게 아니라, ctg_code에 맞춰서 정렬된거였음 ㅠㅠ 앞으로 innner join을 쓰면 꼭 order by 해주자!
    $sql="SELECT * FROM author
        ORDER BY aut_code DESC 
        LIMIT ". $offset." ,". $pagination_length;
    
    $result = $conn->query($sql);
    $upload_path = '../author/a_upload/';

    while ($row = $result->fetch_array()) {
?>      <tr>
            <td><?=$row['aut_code']?></td>
            <td><img src="<?=$upload_path?><?=$row['aut_upload']?>" alt="이미지 준비중"></td>
            <td><?=$row['aut_name']?></td>
            <td><?=$row['aut_interview']?></td>
            <td><?=$row['aut_birth']?></td>
            <td><a href="../author/aut_update.php?aut_code=<?=$row['aut_code']?>">수정</a></td>
            <td><a href="../author/aut_deleteProcess.php?aut_code=<?=$row['aut_code']?>">삭제</a></td>
        </tr>     
<?php        
    }
?>
    </table>
    <div class="pagination">
<?php
//  4. Pagination 버튼 만들기
    if($page_no >1){
        echo "<a href='manage_author.php?page_no=1'>First</a>";
    }
    for($count = $start_page; $count <= $end_page; $count++){
        echo "<a href='manage_author.php?page_no=".$count."'>".$count."</a>";
    }
    if($page_no < $total_pages) {
        echo "<a href='manage_author.php?page_no=".$total_pages."'>Last</a>";
    }
?>
<!-- 5. 개별로 찾아 수정을 하기 위한 검색창 끙... 이거 또 만드러야댈듯 ㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠ-->
    </div>
    <div class="search_result_container">
    <form action="./manage_authorSearch.php" method="GET" class="search_box">
        <select name="s_ctg">
            <option value="aut_name">작가명</option>
            <option value="aut_code">작가코드</option>
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