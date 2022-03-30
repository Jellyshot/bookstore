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
        <h1>작가등록 페이지 입니다.</h1>
        <div class="n_buttons">
        <button onclick="history.back()">뒤로가기</button>
        </div>
        <div class="width80">

        <form action="./aut_insertProcess.php" method="POST" class="writeform" enctype="multipart/form-data">
        <input type="text" name="aut_name" placeholder="작가명"><br>
        <input type="text" name="aut_interview" placeholder="인터뷰"><br>
        <input type="date" name="aut_birth" placeholder="생년월일"><br>
        <input type="file" name="aut_upload"/ ><br>
        <input type="submit" value="등록" style="width:100%;">
        </form>

        </div>
    </main>
<?php } ?>
        
