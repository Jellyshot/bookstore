<?php
// 1. DB연결
    require  '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

    if($chk_login == TRUE && $_SESSION['mem_id'] =='admin'){
// 2. 변수 설정
//  2.1 값 받아오기
    $pbs_code = $_GET['pbs_code'];

// 3. 데이터 가져오기
    $sql = "SELECT * FROM publisher WHERE pbs_code = ".$pbs_code;
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc() > 0){
?>

    <form action="./pbs_updateProcess.php" method="POST" class="writeform" style="float: right;">
    <input type="text" name="pbs_code" value="<?=$pbs_code?>" readonly>
    <input type="text" name="pbs_name" value="<?=$row['pbs_name']?>">
    <input type="text" name="pbs_charge" value="<?=$row['pbs_charge']?>">
    <input type="text" name="pbs_phone" texte="<?=$row['pbs_phone']?>">
    <input type="email" name="pbs_email" value="<?=$row['pbs_email']?>">
    <input type="text" name="pbs_address" value="<?=$row['pbs_address']?>">
    <input type="text" name="pbs_account" value="<?=$row['pbs_account']?>">
    <input type="text" name="pbs_pdate" value="<?=$row['pbs_pdate']?>">
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