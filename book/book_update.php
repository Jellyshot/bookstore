<?php
    // 1. db연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    // 2. 변수 설정
    $book_code = $_GET['book_code'];
    // 3. 화면 구성
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
        $sql = "SELECT * FROM book WHERE book_code=".$book_code;
        $resultset = $conn->query($sql);
        $book = $resultset->fetch_assoc();
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
        <h1>도서수정 페이지 입니다.</h1>
        <div class="n_buttons">
        <button onclick="history.back()">뒤로가기</button>
        </div>
        <div class="width80">

        <form action="./book_updateProcess.php" method="POST" class="writeform" enctype="multipart/form-data">
        <input type="text" name ="book_code" value="<?=$book_code?>" readonly>
        <input type="text" name="book_name" value="<?=$book['book_name']?>"><br>
        <label for="ctg_code">카테고리</label>
        <select name="ctg_code">
<?php   
        // 카테고리 테이블의 ctg_code길이만큼 option 이 생성되고 value값이 설정되게 하기. option의 이름에는 ctg_name 값이 들어가도록.
        $sql = "SELECT * FROM category";
        $resultset = $conn->query($sql);

        while($row = $resultset->fetch_assoc()){
?>      
        <option value="<?=$row['ctg_code']?>"><?=$row['ctg_name']?></option>
<?php   }  ?>
        </select><br>

        <!-- 작가 이름으로 코드 검색해오기 -->
        <div style="display:flex;">
        <input type="text" name="aut_code" id="pInput" value="<?=$book['aut_code']?>" style="float:left; width:80%;">
        <input type="button" onclick="openChild()" value="작가검색" style="float: left; width:20%; margin:16px;">
        </div>
        <!-- id 새로 부여해서 js하나 더 만들깅 -->
        <div style="display:flex;">
        <input type="text" name="pbs_code" id="pInput2" value="<?=$book['pbs_code']?>" style="float:left; width:80%;">
        <input type="button" onclick="openChild2()" value="출판사검색" style="float: left; width:20%; margin:16px;">
        </div>

        <input type="text" name="book_info" value="<?=$book['book_info']?>">

        <div style="display:flex;justify-content: space-between;">
        <input type="text" name="book_cost" value="<?=$book['book_cost']?>" style="float:left; width:48%;">
        <input type="text" name="book_price" value="<?=$book['book_price']?>" style="float:left; width:48%;">
        </div>
        <input type="date" name="book_pdate" value="<?=$book['book_pdate']?>">
        <input type="file" name="book_upload">
        <input type="submit" value="등록" style="width:100%;">
        </form>

        </div>
    </main>
<?php } ?>
        
