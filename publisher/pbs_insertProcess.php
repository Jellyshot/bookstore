<?php

// 1. DB연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
        
// 2. 변수설정

    $pbs_name = $_POST['pbs_name'];
    $pbs_charge = $_POST['pbs_charge'];
    $pbs_phone = $_POST['pbs_phone'];
    $pbs_email = $_POST['pbs_email'];
    $pbs_address = $_POST['pbs_address'];
    $pbs_account = $_POST['pbs_account'];
    $pbs_pdate = $_POST['pbs_pdate'];


// 4. 비밀번호 일치 확인
            if ($mem_pwd != $mem_cpwd) {
                echo outmsg(DIFF_PASSWD);
            }else {

        // 4. INSERT 구문 작성
            
            $sql = $conn->prepare("INSERT INTO publisher(pbs_name, pbs_charge, pbs_phone, pbs_email, pbs_address, pbs_account, pbs_pdate) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $sql->bind_param("sssssss", $pbs_name, $pbs_charge, $pbs_phone, $pbs_email, $pbs_address, $pbs_account, $pbs_pdate);
                $sql->execute();
            }
        // 5. 리소스 반납
            $conn->close();  
            $sql->close();

            echo outmsg(CREATEUSER_SUCCESS);
            header('Location: ../manage/manage_publisher.php');
    } else {

    header('Location: ../membership/mem_login.php');

    }

