<!-- index.php에서 검색버튼 클릭시 나오는 검색결과 페이지 -->

<?php
// 1. DB연결
    require  '../utility/dbconfig.php';
    require '../utility/nav.php';

// 2. 변수 설정
//  2.1 값 받아오기
    $search = $_POST['search'];
    $category = $_POST['s_ctg'];

//  2.2 페이지네이션용 변수
//  2.2.1 페이지 번호 설정
    if(isset($_GET['page_no']) && $_GET['page_no']!=""){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = 1;
    }
//  2.2.2 페이지당 들어갈 레코드 갯수 설정
    $recods_per_page = 20;

//  2.2.3 페이지당 시작할 레코드 위치 설정
    $offset = ($page_no -1) * $recods_per_page;

//  2.2.4 전체 페이지 수 계산
    // $sql = "SELECT book_name, ctg_name, aut_name, pbs_name, book_info, book_price, book_pdate, book_upload FROM book AS b
    // INNER JOIN author AS a ON b.aut_code = a.aut_code
    // INNER JOIN publisher AS p ON b.pbs_code = p.pbs_code
    // INNER JOIN category AS c ON b.ctg_code = c.ctg_code
    // WHERE ".$category. "like '%".$search."%'";
    
    $sql = "SELECT count(*) As total_recods FROM book AS b INNER JOIN author AS a ON b.aut_code = a.aut_code INNER JOIN publisher AS p ON b.pbs_code = p.pbs_code INNER JOIN category AS c ON b.ctg_code = c.ctg_code WHERE ".$category." like '%".$search."%'";
    $result = $conn->query($sql);
    $total_recods = $result->fetch_array();
    $total_recods = $total_recods['total_recods'];

    $total_pages = ceil($total_recods/$recods_per_page);

//  3. 페이지네이션에 들어갈 페이지 수 지정
    $pagination_length = 10;

//  4. 페이지네이션의 첫페이지와 마지막 페이지 설정
    $start_page = floor(($page_no-1)/$pagination_length)*$pagination_length +1;
    $end_page = $start_page + ($pagination_length-1);
        if ($end_page > $total_pages) {
            $end_page = $total_pages;
        }
    $pre_page = $page_no-1;
    $next_page = $page_no+1;

// 3. 검색결과를 나타내는 쿼리문 작성
    $sql = "SELECT book_code, book_name, ctg_name, aut_name, pbs_name, book_info, book_price, book_pdate, book_upload FROM book AS b
    INNER JOIN author AS a ON b.aut_code = a.aut_code
    INNER JOIN publisher AS p ON b.pbs_code = p.pbs_code
    INNER JOIN category AS c ON b.ctg_code = c.ctg_code
    WHERE $category like '%$search%';";
    $resultset = $conn->query($sql);
    $row = mysqli_num_rows($resultset)
    // ***** 이거 있으면 굳이 위에서 pagination을 위한 카운트 sql구문 안해도 되는거 아닐까?
    
?> 
        <h1><?= $search ?>로 검색한 결과</h1>
        <h3 style="text-align:center;">&#91;검색된 결과 : 총 <?= $total_recods ?> 개&#93;</h3><br>
        
        <table>
            <thead>
            <tr>
                <th>표지</th>
                <th>도서코드</th>
                <th>책이름</th>
                <th>카테고리</th>
                <th>작가명</th>
                <th>출판사</th>
                <th>책정보</th>
                <th>가격</th>
                <th>출간일</th>
            </tr>
            </thead>
            <tbody>
<?php
    
    if ($resultset->num_rows >0) {
    //  ***** 위에 num_rows $row에 저장해놓고 num_rows를 다시하는 이유는?
            while($row = $resultset->fetch_array()){
?>
                <tr><a href="./book_searchResult.php?book_code=<?= $row['book_code'] ?>">
                    <td><?= $row['book_upload'] ?></td>
                    <td><?= $row['book_code'] ?></td>
                    <td><?= $row['book_name'] ?></td>
                    <td><?= $row['ctg_name'] ?></td>
                    <td><?= $row['aut_name'] ?></td>
                    <td><?= $row['pbs_name'] ?></td>
                    <td><?= $row['book_info'] ?></td>
                    <td><?= $row['book_price'] ?></td>
                    <td><?= $row['book_pdate'] ?></td>
                </a></tr>
<?php
            }
?>
            </tbody>
        </table>
<?php
//  4. Pagination 버튼 만들기
        if($page_no >1){
            echo "<a href='book_searchResult.php?page_no=1'>First</a>";
        }
        for($count = $start_page; $count <= $end_page; $count++){
            echo "<a href='book_searchResult.php?page_no=".$count."'>".$count."</a>";
        }
        if($page_no < $total_pages) {
            echo "<a href = 'book_searchResult.php?page_no=".$total_pages."'>Last</a>";
        }
    
}else{
        echo "검색 결과가 없습니다";
    }
?>