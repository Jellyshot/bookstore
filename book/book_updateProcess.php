<?php

// 1. DB연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
        
// 2. 변수설정
    $book_code = $_POST['book_code'];
    $book_name = $_POST['book_name'];
    $ctg_code = $_POST['ctg_code'];
    $aut_code = $_POST['aut_code'];
    $pbs_code = $_POST['pbs_code'];
    $book_info = $_POST['book_info'];
    $book_cost = $_POST['book_cost'];
    $book_price = $_POST['book_price'];
    $book_pdate = $_POST['book_pdate'];
    $upload_path = './book_upload/';


// 4. 비밀번호 일치 확인
            if ($mem_pwd != $mem_cpwd) {
                echo outmsg(DIFF_PASSWD);
                header('Location: ../membership/mem_login.php');
            }else {

        // 4. UPDATE 구문 작성
            // 4.1  업로드된 파일이 있으면, 임시이름으로 가져오는데, 앞에 타임스탬프를 찍어주기
            if (isset($_FILES['book_upload']['tmp_name']) && ($_FILES['book_upload']['tmp_name'] != "")){

                $filename = $_FILES['book_upload']['name'];
                $filename = time()."_".$_FILES['book_upload']['name'];

                // 4.2 파일 이동시키기
                if (move_uploaded_file($_FILES['book_upload']['tmp_name'],$upload_path.$filename)) {
                    if(DBG) echo outmsg(UPLOAD_SUCCESS);
                    $sql = "SELECT * FROM book WHERE book_code=".$book_code;
                    $resultset = $conn->query($sql);
                    $row = $resultset->fetch_assoc();

                    $existingfile = $row['book_upload'];

                    if(isset($existingfile)&&$existingfile!=""){
                        unlink($upload_path.$existingfile);
                    }
                }
                
                // 4.3 업로드에 성공하면 file이 포함된 insert 구문 실행
                $sql = $conn->prepare("UPDATE book SET book_name =?, ctg_code=?, aut_code=?, pbs_code=?, book_info=?, book_cost=?, book_price=?, book_pdate=?, book_upload=? where book_code=?");
                $sql->bind_param("siiisiissi", $book_name, $ctg_code, $aut_code, $pbs_code, $book_info, $book_cost, $book_price, $book_pdate,  $filename, $book_code);
                $sql->execute();
            } else {
            // 업로드할 파일이 없을 때의 insert 구문 작성
            $sql = $conn->prepare("UPDATE book SET book_name =?, ctg_code=?, aut_code=?, pbs_code=?, book_info=?, book_cost=?, book_price=?, book_pdate=? where book_code=?");
            $sql->bind_param("siiisiisi", $book_name, $ctg_code, $aut_code, $pbs_code, $book_info, $book_cost, $book_price, $book_pdate,  $book_code);
            $sql->execute();
            }
        }
    }
// 5. 리소스 반납
    $conn->close();  
    $sql->close();

    echo outmsg(CREATEUSER_SUCCESS);
    header('Location: ../manage/admin.php');

