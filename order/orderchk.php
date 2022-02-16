<?php
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    // detail view 에서 넘어 오는 정보
    $mem_id = $_SESSION['mem_id'];
?>
<?php
    // detailview에서 직접 구매하기 버튼을 눌렀을 때 구매정보 불러오기
    if(isset($_POST['book_code']) && isset($_POST['cs_cnt'])){
        
        echo "데이터 정보가 넘어왔습니다  ".$mem_id;
        $book_code = $_POST['book_code'];
        $cs_cnt = $_POST['cs_cnt'];

        // om_code 생성
        $sql = "INSERT INTO ordermain(mem_id) VALUES ('".$mem_id."')";
        $result = $conn->query($sql);

        
        // 가장 최근에 등록된 om_code 따오기
        $sql = "SELECT * FROM ordermain WHERE mem_id='".$_SESSION['mem_id']."' order by om_code desc limit 1 ";      
        $result=$conn->query($sql);
        $result = $result->fetch_assoc();
        $om_code = $result['om_code'];

        // ordersub에 insert
        $stmt = $conn->prepare("INSERT INTO ordersub (om_code, book_code, os_cnt)VALUES (?,?,?)");
        $stmt->bind_param("iii", $om_code, $book_code, $cs_cnt);
        $stmt->execute();

        
    // 장바구니에서 구매하기 버튼을 눌렀을 때 구매정보 불러오기
    }else{

        echo "데이터 정보가 없습니다.";
        //  1. 장바구니(cartsub)의 정보를 select 하기 위해 mem_id로 cm_code를 찾음
        $sql = "SELECT * FROM cartmain WHERE mem_id='".$mem_id."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $cm_code = $row['cm_code'];

        //  2. om_code생성
        $stmt = $conn->query("INSERT INTO ordermain (mem_id) VALUES ('".$mem_id."')");
        
        // 3. 가장 최근에 등록된 om_code 따오기
        $sql = "SELECT * FROM ordermain WHERE mem_id='".$_SESSION['mem_id']."'  order by om_code desc limit 1 ";      
        $result=$conn->query($sql);
        $row = $result->fetch_assoc();
        $om_code = $row['om_code'];

        //  4. cartsub에 있는 데이터와 om_code들을 ordersub에 입력함
        $sql  = "INSERT INTO ordersub (om_code, book_code, os_cnt) 
                    SELECT ".$om_code.", book_code, cs_cnt from cartsub  
                    WHERE cm_code = ".$cm_code;
        $result = $conn->query($sql);
        
    }
    $sql = "DELETE FROM cartmain WHERE mem_id = '".$mem_id."'";
    $result = $conn->query($sql);

?>
    <script>
        alert ("구매가 완료되었습니다.");
            location.href="../membership/myorder.php?mem_id=<?=$mem_id?>";
    </script>
</div>