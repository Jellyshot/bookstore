<?php
    require  '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    // 로그인이 되어 있고, 로그인된 사용자가 admin 이면 프로세스 실행
    if($chk_login == TRUE && $_SESSION['mem_id'] =='admin'){
        
        $pbs_code = $_POST['pbs_code'];
        $pbs_name = $_POST['pbs_name'];
        $pbs_charge = $_POST['pbs_charge'];
        $pbs_phone = $_POST['pbs_phone'];
        $pbs_email = $_POST['pbs_email'];
        $pbs_address = $_POST['pbs_address'];
        $pbs_account = $_POST['pbs_account'];
        $pbs_pdate = $_POST['pbs_pdate'];
                
        $sql = "SELECT * FROM publisher WHERE pbs_code = ".$pbs_code;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("UPDATE publisher SET pbs_name = ?, pbs_charge = ?, pbs_phone = ? , pbs_email = ?, pbs_address = ?, pbs_account = ?, pbs_pdate = ?, WHERE pbs_code = ?");
        $stmt->bind_param("ssssssss", $pbs_name, $pbs_charge, $pbs_phone, $pbs_email, $pbs_address, $pbs_account, $pbs_pdate, $pbs_code);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        echo outmsg(UPDATE_SUCCESS);
        header('Location: ../manage/manage_publisherSearch.php?s_ctg=pbs_code&search='.$pbs_code);
    }else{
        echo "<script>alert('접근권한이 없습니다'); location.href='../index.php';</script>";
    }//end of confirm id
