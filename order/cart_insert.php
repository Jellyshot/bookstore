<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    $mem_id = $_SESSION['mem_id'];
    $book_code = $_POST['book_code'];
    $cs_cnt = $_POST['cs_cnt'];

    // cart main에 구매자 id입력(한번만)
    $stmt = "SELECT mem_id FROM cartmain WHERE mem_id='".$mem_id."'";
    $stmt = $conn->query($stmt);

    if ($stmt->num_rows <= 0) {
        $sql = "INSERT INTO cartmain(mem_id) VALUES('".$mem_id."')";
        $conn->query($sql);        
    }

    // cm_code따와서 cartsub테이블에 넣기 cm_code 이렇게 따오는거 맞는지 확인! 
    $sql = "SELECT * FROM cartmain WHERE mem_id='".$mem_id."'";
    $resultset = $conn->query($sql);

    if($resultset->num_rows>0){
        $row= $resultset->fetch_assoc();
        $cm_code = $row['cm_code'];
    }

    // cart sub에 책 정보 입력
    
    $sql= "INSERT INTO cartsub(cm_code, book_code, cs_cnt) VALUES ('".$cm_code."','". $book_code."','". $cs_cnt."')";
    $conn->query($sql);
    
    $conn->close();
    // $sql은 close가 왜 안생기는걸까요?
    ?>
    <script>
        let cl = confirm("장바구니로 이동하시겠습니까?");
        if (cl){
            location.href="./cart_list.php?cm_code=<?= $cm_code ?>"
        }else{
            location.href="../book/book_datailview.php?=<?=$book_code?>"
        }
    </script>
</body>
</html>