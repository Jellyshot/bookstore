<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&family=Roboto&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<script defer src="/js/nav.js"></script>

<header class="header" id="header">
    <div class="header_left">
    <a class=active href="../index.php">A-book's</a>
    <a href="./notice/notice_list.php">공지사항</a>
    <a href="">도서추천</a>
    <a href="">자유게시판</a>
    </div>
    <div class="header_right">
<?php
require 'loginchk.php';
if($chk_login) {
    switch ($_SESSION['mem_id']) {
        case 'admin':
    ?>
            <a href="">관리자모드</a>
            <a href="/membership/mem_logout.php">로그아웃</a>
    <?php
            break;
        default:
    ?>
            <div class="drop_menu">
            <button>마이페이지<i class="fa fa-caret-down"></i></button>
            <div class="column">
                <a href="">쪽지함</a>
                <a href="">회원정보수정</a>
                <a href="">구매내역</a>
            </div>
            </div>
            <a href="/membership/mem_logout.php">로그아웃</a>
    <?php
            break;
    } 
} else {
?>
    <a href="../membership/mem_regist.php">회원가입</a>
    <a href="/membership/mem_login.php">로그인</a>
<?php
        }

?>
    <a href="javascript:void(0);" style="font: size 20px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
</header>