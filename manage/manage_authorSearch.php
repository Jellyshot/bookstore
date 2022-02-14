<?php
// 1. DB연결
    require  '../utility/dbconfig.php';
    require '../utility/nav.php';

// 2. 변수 설정
//  2.1 값 받아오기
    $search = $_GET['search'];
    $category = $_GET['s_ctg'];


// 3. 화면구성
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
            $sql="SELECT * FROM author
                WHERE ".$category." like '%".$search."%'
                ORDER BY aut_code DESC ";
            
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
        }
        ?>
            </tbody>
        </table>
</div>
</body>
</html>