<?php
// 1. DB연결
    require  '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

    if($chk_login == TRUE && $_SESSION['mem_id'] =='admin'){
// 2. 변수 설정
//  2.1 값 받아오기
    $aut_code = $_GET['aut_code'];
    $upload_path = './aut_upload/';

// 3. 데이터 가져오기
    $sql = "SELECT * FROM author WHERE aut_code = ".$aut_code;
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc() > 0){
?>
    <img src="<?=$upload_path?><?=$row['aut_upload']?>" alt="이미지 준비중" style="float: left;">

    <form action="./aut_updateProcess.php" method="POST" class="writeform" style="float: right;">
    <input type="text" name="aut_code" value="<?=$aut_code?>" readonly>
    <input type="text" name="aut_name" value="<?=$row['aut_name']?>">
    <input type="text" name="aut_interview" value="<?=$row['aut_interview']?>">
    <input type="date" name="aut_birth" value="<?=$row['aut_birth']?>">
    <input type="file" name="aut_upload" value="<?=$row['aut_upload']?>">
    <input type="submit" value="저장">
    <input type="button" value="취소" onclick="history.back(-1)">
    </form>
    <div>
<?php
    }else{
        echo "검색결과가 없습니다";
    }
}else{
    echo ("<script LANGUAGE='JavaScript'>
            window.alert('접근권한이 없습니다');
            window.location.href='../index.php';
            </script>");
}
?>
    </div>
</body>
</html>