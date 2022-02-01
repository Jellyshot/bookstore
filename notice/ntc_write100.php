<?php
    require '../utility/dbconfig.php';

    if($_SESSION['mem_id']=='admin'){
        for($i = 0; $i < 100; $i++){
            $ntc_subject = "공지사항".$i;
            $ntc_contents = "공지사항 테스트 입니다".$i;

            $stmt = $conn->prepare("INSERT INTO notice(ntc_subject, ntc_contents) VALUES(?,?)");
            $stmt->bind_param("ss",$ntc_subject, $ntc_contents);
            $stmt->execute();
        }
        $conn->close();
        $stmt->close();

        header('Location: ./ntc_list.php');
    }else{
        echo "글쓰기 권한이 없습니다.";
        header('Location: ./ntc_list.php');
    }
?>