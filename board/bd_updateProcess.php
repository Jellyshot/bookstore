<?php
//  1. 데이터 베이스 연결하고!
    require '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    if($chk_login){

        $bd_code = $_POST['bd_code'];
        $bd_subject = $_POST['bd_subject'];
        $bd_contents = $_POST['bd_contents'];
        // $bd_upload = $_POST['bd_upload'];
        $upload_path = './bd_upload/';

//  2. 첨부파일이 있으면 이름 정의 및 파일 위치 지정 시키기
    if(isset($_FILES['bd_upload']['tmp_name']) && ( $_FILES['bd_upload']['tmp_name'] != "")) {

        //일단 파일 네임 정의해주고
        $filename = $_FILES['bd_upload']['name'];

        //이름중복처리 방지
        $filename = time()."_".$_FILES['bd_upload']['name'];
        
        //file이 정상적으로 업로드가 되어있으면, 기존 파일이 있는경우 삭제처리 하고 테이블에 추가하는 코드 작성.
        if(move_uploaded_file($_FILES['bd_upload']['tmp_name'], $upload_path.$filename)){

                $sql="SELECT * FROM board WHERE bd_code ='" .$bd_code. "'";
                $resultset = $conn->query($sql);
                $row = $resultset->fetch_assoc();
                // fatch_row: 인덱스에 따른 값이 불려옴
                // fatch_assoc: 열에 따른 값이 불려옴
                // fatch_array: 인덱스와 열에 따른 값이 불려옴.
                // 기존파일 삭제를 위해 해당 id의 'bd_upload' 열 값을 exixtingfile에 저장함
                $existingfile = $row['bd_upload'];

                if(isset($existingfile) && $existingfile !=""){
                    unlink($upload_path.$existingfile); 
                    //파일이 있으면 지운다(unlink)
                }
        }
    
    // 3. 업데이트 처리를 위한 prepared sql 구성 및 bind
        $stmt = $conn->prepare("UPDATE board SET bd_subject = ?, bd_contents = ?, bd_upload = ? WHERE bd_code = ?");
        $stmt->bind_param("ssss", $bd_subject, $bd_contents, $filename, $bd_code);

    }else { 
        // 업로드 된 파일이 없을 때 업데이트 처리를 위한 prepared sql 구성 및 bind param
        $stmt = $conn->prepare("UPDATE board SET bd_subject = ?, bd_contents = ? WHERE bd_code = ?" );
        $stmt->bind_param("sss", $bd_subject, $bd_contents, $bd_code);
    }
    $stmt->execute();
    
    // 5. 리소스 반납
        $conn->close();  
        $stmt->close();
    
        echo outmsg(UPDATE_SUCCESS);
        header('Location: ./bd_list.php');
}else{
    echo outmsg(LOGIN_NEED);
}
?>
