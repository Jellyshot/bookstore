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

    $sql = "SELECT count(*) As total_recods FROM publisher
    ORDER BY pbs_code desc";

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
        <h1>거래처관리 페이지 입니다.</h1>
        <div class="n_buttons">
        <a href="../publisher/pbs_insert.php">거래처추가</a>
        </div>
        <table>
            <th>거래처코드</th>
            <th>거래처명</th>
            <th>담당자명</th>
            <th>담당자 연락처</th>
            <th>담당자 이메일</th>
            <th>거래처 주소</th>
            <th>계좌번호</th>
            <th>대금지불일</th>
            <th colspan="2">관리</th>
        
<?php
    // 카테고리 1값만 가져오네;;;뭐지;;;;;;??
    // 1만 가져온게 아니라, ctg_code에 맞춰서 정렬된거였음 ㅠㅠ 앞으로 innner join을 쓰면 꼭 order by 해주자!
    $sql="SELECT * FROM publisher
        ORDER BY pbs_code DESC 
        LIMIT ". $offset." ,". $pagination_length;
        
    
    $result = $conn->query($sql);

    while ($row = $result->fetch_array()) {
?>      <tr>
            <td><?=$row['pbs_code']?></td>
            <td><?=$row['pbs_name']?></td>
            <td><?=$row['pbs_charge']?></td>
            <td><?=$row['pbs_phone']?></td>
            <td><?=$row['pbs_email']?></td>
            <td><?=$row['pbs_address']?></td>
            <td><?=$row['pbs_account']?></td>
            <td><?=$row['pbs_pdate']?>일</td>
            <td><a href="../publisher/pbs_update.php?pbs_code=<?=$row['pbs_code']?>">수정</a></td>
            <td><a href="../publisher/pbs_deleteProcess.php?pbs_code=<?=$row['pbs_code']?>">삭제</a></td>
        </tr>     
<?php        
    }
?>
    </table>
    <div class="pagination">
<?php
//  4. Pagination 버튼 만들기
    if($page_no >1){
        echo "<a href='manage_publisher.php?page_no=1'>First</a>";
    }
    for($count = $start_page; $count <= $end_page; $count++){
        echo "<a href='manage_publisher.php?page_no=".$count."'>".$count."</a>";
    }
    if($page_no < $total_pages) {
        echo "<a href='manage_publisher.php?page_no=".$total_pages."'>Last</a>";
    }
?>
<!-- 5. 개별로 찾아 수정을 하기 위한 검색창 끙... 이거 또 만드러야댈듯 ㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠ-->
    </div>
    <div class="search_result_container">
    <form action="./manage_publisherSearch.php" method="GET" class="search_box">
        <select name="s_ctg">
            <option value="pbs_name">출판사명</option>
            <option value="pbs_code">출판사 코드</option>
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