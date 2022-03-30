<?php

// 1. DB연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
        
// 2. 변수설정
    $aut_name = $_POST['aut_name'];
    $aut_interview = $_POST['aut_interview'];
    $aut_birth = $_POST['aut_birth'];
    
    $upload_path = './aut_upload/';


// 4. 비밀번호 일치 확인
            if ($mem_pwd != $mem_cpwd) {
                echo outmsg(DIFF_PASSWD);
            }else {

        // 4. INSERT 구문 작성
            // 4.1  업로드된 파일이 있으면, 임시이름으로 가져오는데, 앞에 타임스탬프를 찍어주기
            if (is_uploaded_file($_FILES['aut_upload']['tmp_name'])) {
                $filename = time()."_".$_FILES['aut_upload']['name'];

                // 4.2 파일 이동시키기
                if (move_uploaded_file($_FILES['aut_upload']['tmp_name'],$upload_path.$filename)) {
                    if(DBG) echo outmsg(UPLOAD_SUCCESS);
                }
                // 4.3 업로드에 성공하면 file이 포함된 insert 구문 실행
                $sql = $conn->prepare("INSERT INTO author(aut_name, aut_interview, aut_birth, aut_upload) VALUES (?, ?, ?, ?)");
                $sql->bind_param("ssss", $aut_name, $aut_interview, $aut_birth, $filename);
                $sql->execute();
            }else{
            // 업로드할 파일이 없을 때의 insert 구문 작성
            $sql = $conn->prepare("INSERT INTO author(aut_name, aut_interview, aut_birth) VALUES (?, ?, ?)");
                $sql->bind_param("sss", $aut_name, $aut_interview, $aut_birth);
                $sql->execute();
            }
        }

// 5. 리소스 반납
    $conn->close();  
    $sql->close();

    echo outmsg(CREATEUSER_SUCCESS);
    header('Location: ../manage/manage_author.php');
} else {
    header('Location: ../membership/mem_login.php');
}
