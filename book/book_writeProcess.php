<?php

// 1. DB연결
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    
    if(isset($_SESSION['mem_id']) && ($_SESSION['mem_id'] != '') && ($_SESSION['mem_id'] == 'admin')) { 
        
// 2. 변수설정
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
            }else {

        // 4. INSERT 구문 작성
            // 4.1  업로드된 파일이 있으면, 임시이름으로 가져오는데, 앞에 타임스탬프를 찍어주기
            if (is_uploaded_file($_FILES['book_upload']['tmp_name'])) {
                $filename = time()."_".$_FILES['book_upload']['name'];

                // 4.2 파일 이동시키기
                if (move_uploaded_file($_FILES['book_upload']['tmp_name'],$upload_path.$filename)) {
                    if(DBG) echo outmsg(UPLOAD_SUCCESS);
                }
                // 4.3 업로드에 성공하면 file이 포함된 insert 구문 실행
                $sql = $conn->prepare("INSERT INTO book(book_name, ctg_code, aut_code, pbs_code, book_info, book_cost, book_price, book_pdate, book_upload) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bind_param("siiisiiss", $book_name, $ctg_code, $aut_code, $pbs_code, $book_info, $book_cost, $book_price, $book_pdate,  $filename);
                $sql->execute();
            }else{
            // 업로드할 파일이 없을 때의 insert 구문 작성
            $sql = $conn->prepare("INSERT INTO book(book_name, ctg_code, aut_code, pbs_code, book_info, book_cost, book_price, book_pdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bind_param("siiisiiss", $book_name, $ctg_code, $aut_code, $pbs_code, $book_info, $book_cost, $book_price, $book_pdate);
                $sql->execute();
            }
        }

// 5. 리소스 반납
    $conn->close();  
    $sql->close();

    echo outmsg(CREATEUSER_SUCCESS);
    header('Location: ../manage/admin.php');
} else {
    header('Location: ../membership/mem_login.php');
}
