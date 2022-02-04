<?php
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    // session값을 쓰려면 session start가 있어야함.
    if($_SESSION['mem_id'] == 'admin'){
        for($i = 0; $i < 300; $i++){
            $bd_subject = "자유게시판".$i;
            $bd_contents = "자유게시판 테스트 입니다".$i;
            $mem_id = $_SESSION['mem_id'];
            $stmt = $conn->prepare("INSERT INTO notice(bd_subject, bd_contents, mem_id)VALUES(?, ?, ?)");
            $stmt->bind_param("sss",$bd_subject, $bd_contents, $mem_id);
            $stmt->execute();
        }
        $conn->close();
        $stmt->close();

        header('Location: ./bd_list.php');
    }else{
?>
    <script>
        alert("글쓰기 권한이 없습니다");
        location.href= "./bd_list.php";
    </script>
    
<?php
    }
?>