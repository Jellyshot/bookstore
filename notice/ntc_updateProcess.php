<?php
    // DB연결
    require '../utility/dbconfig.php';

if (isset($_SESSION['mem_id']) && $_SESSION['mem_id'] != '' && $_SESSION['mem_id'] == 'admin') {
    // 변수설정
    $ntc_code = $_POST['ntc_code'];
    $ntc_subject = $_POST['ntc_subject'];
    $ntc_contents = $_POST['ntc_contetns'];


    $upload_path = './ntc_upload/';


    // 첨부파일이 있으면 이름 변경 및 파일 저장 위치 지정
    if(isset($_FILES['ntc_upload']['tmp_name']) && ($_FILES['ntc_upload']['tmp_name'] !="")){

        $filename = $_FILES['ntc_upload']['name'];

        //이름중복처리 방지
        $filename = time()."_".$_FILES['ntc_upload']['name'];
        
        //file이 정상적으로 업로드가 되어있으면, 기존 파일이 있는경우 삭제처리 하고 테이블에 추가하는 코드 작성.
        if(move_uploaded_file($_FILES['ntc_upload']['tmp_name'], $upload_path.$filename)){

            $sql="SELECT * FROM notice WHERE ntc_code ='" .$ntc_code. "'";
            $resultset = $conn->query($sql);
            $row = $resultset->fetch_assoc();
            // fatch_row: 인덱스에 따른 값이 불려옴
            // fatch_assoc: 열에 따른 값이 불려옴
            // fatch_array: 인덱스와 열에 따른 값이 불려옴.
            // 기존파일 삭제를 위해 해당 id의 'bd_upload' 열 값을 exixtingfile에 저장함
            $existingfile = $row['ntc_upload'];

            if(isset($existingfile) && $existingfile !=""){
                unlink($upload_path.$existingfile); 
                //파일이 있으면 지운다(unlink)
            }
        }

    // 3. 업데이트 처리를 위한 prepared sql 구성 및 bind
    $stmt = $conn->prepare("UPDATE notice SET ntc_subject = ?, ntc_contents = ?, ntc_upload = ? WHERE ntc_code = ?");
    $stmt->bind_param("ssss", $ntc_subject, $ntc_contents, $filename, $ntc_code);

    }else { 
    // 업로드 된 파일이 없을 때 업데이트 처리를 위한 prepared sql 구성 및 bind param
    $stmt = $conn->prepare("UPDATE notice SET ntc_subject = ?, ntc_contents = ? WHERE ntc_code = ?" );
    $stmt->bind_param("sss", $ntc_subject, $ntc_contents, $ntc_code);
    }
    $stmt->execute();

    // 5. 리소스 반납
    $conn->close();  
    $stmt->close();

    echo outmsg(UPDATE_SUCCESS);
    header('Location: ./bd_detailview.php');
}else{
    echo "접근 권한이 없습니다.";
}
