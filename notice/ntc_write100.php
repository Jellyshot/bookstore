<?php
    require '../utility/dbconfig.php';

// 아닝이거 왜 안대 ㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠ
    if($_SESSION['mem_id'] == 'admin'){
        for($i = 0; $i < 300; $i++){
            $ntc_subject = "공지사항".$i;
            $ntc_contents = "공지사항 테스트 입니다".$i;
            $mem_id = $_SESSION['mem_id'];
            $stmt = $conn->prepare("INSERT INTO notice(ntc_subject, ntc_contents, mem_id)VALUES(?, ?, ?)");
            $stmt->bind_param("sss",$ntc_subject, $ntc_contents, $mem_id);
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