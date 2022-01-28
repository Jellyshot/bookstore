<?php

// 1. DB연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';
    
        
// 2. 변수설정

    $mem_id = $_POST['mem_id'];
    $mem_name = $_POST['mem_name'];
    $mem_adress = $_POST['mem_address'];
    $mem_phone = $_POST['mem_phone'];
    $mem_email = $_POST['mem_email'];
    $mem_profile = $_POST['mem_profile'];
    $upload_path = './profile/';

    
//  3. 기존 파일이 있으면 삭제하고 없으면 이름붙여주고 파일 이동시키기
    if(isset($_FILES['mem_profile']['tmp_name']) && ( $_FILES['mem_profile']['tmp_name'] != "")) {
    //일단 파일 네임 정의해주고
    $filename = $_FILES['mem_profile']['name'];
    //이름중복처리 방지
    $filename = time()."_".$_FILES['mem_profile']['name'];
    
    //file이 정상적으로 업로드가 되어있으면, 기존 파일이 있는경우 삭제처리 하고 테이블에 추가하는 코드 작성.
    if(move_uploaded_file($_FILES['mem_profile']['tmp_name'], $upload_path.$filename)){
                $sql="SELECT * FROM membership WHERE mem_id =" .$mem_id ;
                $resultset = $conn->query($sql);
                $row = $resultset->fetch_assoc();
                // fatch_row: 인덱스에 따른 값이 불려옴
                // fatch_assoc: 열에 따른 값이 불려옴
                // fatch_array: 인덱스와 열에 따른 값이 불려옴.
                // 기존파일 삭제를 위해 해당 id의 'mem_profile' 열 값을 exixtingfile에 저장함
                $existingfile = $row['mem_profile'];

                if(isset($existingfile) && $existingfile !=""){
                    unlink($upload_path.$existingfile); 
                  //파일이 있으면 지운다(unlink)
                }
    }

// 4. 업데이트 처리를 위한 prepared sql 구성 및 bind
    $stmt = $conn->prepare("UPDATE membership SET mem_name = ?, mem_address = ?, mem_phone = ?, mem_email = ?, mem_profile = ? WHERE mem_id = ?" );
    $stmt->bind_param("ssssss", $mem_name, $mem_address, $mem_phone, $mem_email, $mem_profile, $mem_id);
}else { 
// 업로드 된 파일이 없을 때 업데이트 처리를 위한 prepared sql 구성 및 bind param
$stmt = $conn->prepare("UPDATE membership SET mem_name = ?, mem_address = ?, mem_phone = ?, mem_email = ? WHERE mem_id = ?" );
$stmt->bind_param("sssss", $mem_name, $mem_address, $mem_phone, $mem_email, $mem_id);
}
$stmt->execute();

// 5. 리소스 반납
    $conn->close();  
    $sql->close();
    $stmt->close();

    echo outmsg(UPDATE_SUCCESS);
    header('Location: ./mypage.php');
