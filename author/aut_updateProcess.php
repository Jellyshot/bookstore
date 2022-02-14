<?php
    require  '../utility/dbconfig.php';
    require_once '../utility/loginchk.php';

    // 로그인이 되어 있고, 로그인된 사용자가 admin 이면 프로세스 실행
    if($chk_login == TRUE && $_SESSION['mem_id'] =='admin'){
        
        $aut_code = $_POST['aut_code'];
        $aut_name = $_POST['aut_name'];
        $aut_interview = $_POST['aut_interview'];
        $aut_birth = $_POST['aut_birth'];

        $upload_path = './aut_upload/' ;

        if(isset($_FILES['aut_upload']['tmp_name']) && ( $_FILES['aut_upload']['tmp_name'] != "")) {
            $filename = $_FILES['aut_upload']['name'];
            $filename = time()."_".$_FILES['aut_upload']['name'];

            if (move_uploaded_file($_FILES['aut_upload']['tmp_name'], $upload_path.$filename)) {
                
                $sql = "SELECT * FROM author WHERE aut_code = ".$aut_code;
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                $existingfile = $row['aut_upload'];

                if(isset($existingfile) && $existingfile !=""){
                    unlink($upload_path.$existingfile); 
                  //파일이 있으면 지운다(unlink)
                }
            }//end of move_uploaded file

            $stmt = $conn->prepare("UPDATE author SET aut_name = ?, aut_interview = ?, aut_birth = ?, aut_upload = ?, WHERE aut_code = ?");
            $stmt->bind_param("sssss", $aut_name, $aut_interview, $aut_birth, $filename, $aut_code);

        }else{
            $stmt = $conn->prepare("UPDATE author SET aut_name = ?, aut_interview = ?, aut_birth = ? ,WHERE aut_code = ?");
            $stmt->bind_param("ssss", $aut_name, $aut_interview, $aut_birth, $aut_code);
        } //end of isset $_Files 
        $stmt->execute();

        $stmt->close();
        $conn->close();

        echo outmsg(UPDATE_SUCCESS);
        header('Location: ../manage/manage_authorSearch.php?s_ctg=aut_code&search='.$aut_code);
    }else{
        echo "<script>alert('접근권한이 없습니다'); location.href='../index.php';</script>";
    }//end of confirm id
?>