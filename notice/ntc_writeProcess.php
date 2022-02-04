<?php

// 1. DB연결 및 로그인 체크
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';
// 2. 관리자 로그인 확인
if($_SESSION['mem_id']=='admin'){

    $ntc_subject = $_POST['ntc_subject'];
    $ntc_contents = $_POST['ntc_contents'];
    $mem_id = $_SESSION['mem_id'];
    $upload_path = './n_upload/';

// 3. 업로드된 파일이 있으면, 이름 부여하고 폴더이동한 후 테이블에 입력
    if(is_uploaded_file($_FILES['ntc_upload']['tmp_name'])){
        $filename = time()."_".$_FILES['ntc_upload']['name'];

        if(move_uploaded_file($_FILES['ntc_upload']['tmp_name'],$upload_path.$filename)){
            if(DBG) echo outmsg(UPLOAD_SUCCESS);

            $stmt =$conn->prepare("INSERT INTO notice(ntc_subject, ntc_contents, mem_id, ntc_upload) VALUES(?,?,?,?)") ;
            $stmt->bind_param("ssss", $ntc_subject, $ntc_contents, $mem_id, $filename);
            $stmt->execute();
        }else{
            if(DBG) echo outmsg(UPLOAD_FAIL);
        }
//  4. 업로드된 파일이 없는 경우, 받아온 값 테이블에 입력
    }else{
        $stmt =$conn->prepare("INSERT INTO notice(ntc_subject, ntc_contents, mem_id) VALUES(?,?,?)") ;
        $stmt->bind_param("sss", $ntc_subject, $ntc_contents, $mem_id);
        $stmt->execute();
    }
//  5. 리소스 반납
    $stmt->close();
    $conn->close(); 

    header('Location: ./ntc_list.php');
//  6. 로그인한 아이디가 admin이 아닌 경우, 공지사항 목록페이지로 강제이동
}else{
    header('Location: ./ntc_list.php');
}
?>