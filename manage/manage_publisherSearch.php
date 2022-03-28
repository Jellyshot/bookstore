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
                <h1>거래처관리 페이지 입니다.</h1>
                <div class="n_buttons">
                <a href="../author/aut_insert.php">작가추가</a>
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
            $sql="SELECT * FROM publisher
                WHERE ".$category." like '%".$search."%'
                ORDER BY pbs_code DESC ";
            
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
                    <td><?=$row['pbs_pdate']?></td>
                    <td><a href="../publisher/pbs_update.php?pbs_code=<?=$row['pbs_code']?>">수정</a></td>
                    <td><a href="../publisher/pbs_deleteProcess.php?pbs_code=<?=$row['pbs_code']?>">삭제</a></td>
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