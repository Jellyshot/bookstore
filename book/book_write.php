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
        <a href="./admin.php">도서관리</a>
        <a href="./manage_publisher.php">거래처관리</a>
        <a href="./manage_author.php">작가정보관리</a>
        <a href="./manage_member.php">회원관리</a>
        <a href="./manage_order.php">주문관리</a>
    </aside>
    <main>
        <h1>도서등록 페이지 입니다.</h1>
        <div class="n_buttons">
        <button onclick="history.back()">뒤로가기</button>
        </div>
        <div class="width80">

        <form action="./book_writeProcess.php" method="POST" class="writeform" enctype="multipart/form-data">
        <input type="text" name="book_name" placeholder="도서명"><br>
        <label for="ctg_code">카테고리</label>
        <select name="ctg_code">
<?php   
        // 카테고리 테이블의 ctg_code길이만큼 option 이 생성되고 value값이 설정되게 하기. option의 이름에는 ctg_name 값이 들어가도록.
        $sql = "SELECT * FROM category";
        $resultset = $conn->query($sql);

        while($row = $resultset->fetch_assoc()){
?>      <option value="<?=$row['ctg_code']?>"><?=$row['ctg_name']?></option>
<?php   }  ?>
        </select><br>

        <!-- 작가 이름으로 코드 검색해오기 -->
        <input type="text" name="aut_code" id="pInput" placeholder="작가코드">
        <input type="button" onclick="openChild()" value="작가검색">

        <!-- id 새로 부여해서 js하나 더 만들깅 -->
        <input type="text" name="pbs_code" id="pInput" placeholder="출판사코드">
        <input type="button" onclick="openChild2()" value="출판사검색">

        <input type="text" name="book_info" placeholder="도서정보">
        <input type="text" name="book_cost" placeholder="구매단가">
        <input type="text" name="book_price" placeholder="판매단가">
        <input type="file" name="book_upload">
        <input type="submit" value="등록">
        </form>

        </div>
    </main>
<?php } ?>
        
