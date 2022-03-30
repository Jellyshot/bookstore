<?php
    // 1. db연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    // 2. 변수 설정
    $pbs_code = $_GET['pbs_code'];
    // 3. 화면 구성
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
        $sql = "SELECT * FROM publisher WHERE pbs_code=".$pbs_code;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
?>  
    
    <aside>
        <a href="../manage/admin.php">도서관리</a>
        <a href="../manage/manage_publisher.php">거래처관리</a>
        <a href="../manage/manage_author.php">작가정보관리</a>
        <a href="../manage/manage_member.php">회원관리</a>
        <a href="../manage/manage_order.php">주문관리</a>
    </aside>
    <main>
        <h1>거래처등록 페이지 입니다.</h1>
        <div class="n_buttons">
        <button onclick="history.back()">뒤로가기</button>
        </div>
        <div class="width80">

        <form action="./pbs_updateProcess.php" method="POST" class="writeform" >
            <input type="text" name="pbs_code" value="<?=$row['pbs_code']?>" readonly>
            <input type="text" name="pbs_name" value="<?=$row['pbs_name']?>">
            <input type="text" name="pbs_charge" value="<?=$row['pbs_charge']?>" >
            <input type="text" name="pbs_phone" value="<?=$row['pbs_phone']?>" >
            <input type="email" name="pbs_email" value="<?=$row['pbs_email']?>" >
            <input type="text" name="pbs_address" value="<?=$row['pbs_address']?>" >
            <input type="text" name="pbs_account" value="<?=$row['pbs_account']?>" >
            <input type="text" name="pbs_pdate" value="<?=$row['pbs_pdate']?>" >
           
            <input type="submit" value="등록" style="width:100%;">
        </form>

        </div>
    </main>
<?php } ?>
        
