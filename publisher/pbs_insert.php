<?php
    // 1. db연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    // 2. 변수 설정

    // 3. 화면 구성
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
?>  
    <script defer src="../js/wopen.js"></script>
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

        <form action="./pbs_insertProcess.php" method="POST" class="writeform" >
            <input type="text" name="pbs_name" placeholder="거래처명"><br>
            <input type="text" name="pbs_charge" placeholder="담당자명" >
            <input type="text" name="pbs_phone" placeholder="연락처" >
            <input type="email" name="pbs_email" placeholder="이메일" >
            <input type="text" name="pbs_address" placeholder="회사주소" >
            <input type="text" name="pbs_account" placeholder="계좌번호" >
            <input type="text" name="pbs_pdate" placeholder="결제일" >
           
            <input type="submit" value="등록" style="width:100%;">
        </form>

        </div>
    </main>
<?php } ?>
        
