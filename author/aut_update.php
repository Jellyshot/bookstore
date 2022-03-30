<?php
    // 1. db연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    // 2. 변수 설정
    $aut_code = $_GET['aut_code'];
    // 3. 화면 구성
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
        $sql = "SELECT * FROM author WHERE aut_code=".$aut_code;
        $resultset = $conn->query($sql);
        $aut = $resultset->fetch_assoc();
?>  
    <aside>
        <a href="../manage/admin.php">도서관리</a>
        <a href="../manage/manage_publisher.php">거래처관리</a>
        <a href="../manage/manage_author.php">작가정보관리</a>
        <a href="../manage/manage_member.php">회원관리</a>
        <a href="../manage/manage_order.php">주문관리</a>
    </aside>
    <main>
        <h1>작가정보 수정페이지 입니다.</h1>
        <div class="n_buttons">
        <button onclick="history.back()">뒤로가기</button>
        </div>
        <div class="width80">

        <form action="./aut_updateProcess.php" method="POST" class="writeform" enctype="multipart/form-data">
        <input type="text" name="aut_code" value="<?=$aut['aut_code']?>"><br>
        <input type="text" name="aut_name" value="<?=$aut['aut_name']?>"><br>
        <input type="text" name="aut_interview" value="<?=$aut['aut_interview']?>"><br>
        <input type="date" name="aut_birth" value="<?=$aut['aut_birth']?>"><br>
        <input type="file" name="aut_upload"/ ><br>
        <input type="submit" value="등록" style="width:100%;">
        </form>

        </div>
    </main>
<?php } ?>
        
