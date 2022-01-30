<?php

// 1. DB연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    
    if(isset($_POST['mem_id']) && $_POST['mem_id']!=''){
        
// 2. 변수설정
    $mem_id = $_POST['mem_id'];
    $mem_pwd = $_POST['mem_pwd'];
    $mem_cpwd = $_POST['mem_cpwd'];
    $mem_name = $_POST['mem_name'];
    $mem_adress = $_POST['mem_address'];
    $mem_phone = $_POST['mem_phone'];
    $mem_email = $_POST['mem_email'];
    $mem_profile = $_POST['mem_profile'];
    $upload_path = './profile/';


// 4. 비밀번호 일치 확인
            if ($mem_pwd != $mem_cpwd) {
                echo outmsg(DIFF_PASSWD);
            }else {

        // 4. INSERT 구문 작성
            // 4.1  업로드된 파일이 있으면, 임시이름으로 가져오는데, 앞에 타임스탬프를 찍어주기
            if (is_uploaded_file($_FILES['mem_profile']['tmp_name'])) {
                $filename = time()."_".$_FILES['mem_profile']['name'];
            // 4.2 파일 이동시키기
            if (move_uploaded_file($_FILES['mem_profile']['tmp_name'],$upload_path.$filename)) {
                if(DBG) echo outmsg(UPLOAD_SUCCESS);
            }
            // 4.3 업로드에 성공하면 file이 포함된 insert 구문 실행
            $sql = $conn->prepare("INSERT INTO membership(mem_id, mem_pwd, mem_name, mem_address, mem_phone, mem_email, mem_profile) VALUES (?, sha2(?,256), ?, ?, ?, ?, ?)");
            $sql->bind_param("sssssss",$mem_id, $mem_pwd, $mem_name, $mem_address, $mem_phone, $mem_email, $mem_profile);
            $sql->execute();
            }else{
            // 업로드할 파일이 없을 때의 insert 구문 작성
            $sql = $conn->prepare("INSERT INTO membership(mem_id, mem_pwd, mem_name, mem_address, mem_phone, mem_email) VALUES (?, sha2(?,256), ?, ?, ?, ?)");
            $sql->bind_param("ssssss",$mem_id, $mem_pwd, $mem_name, $mem_address, $mem_phone, $mem_email);
            $sql->execute();
            }
        }

// 5. 리소스 반납
    $conn->close();  
    $sql->close();

    echo outmsg(CREATEUSER_SUCCESS);
    header('Location: ./mem_login.php');
} else {
    header('Location: ./mem_regist.php');
}
 
?>