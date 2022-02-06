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
    <a href="../notice/ntc_list.php">공지사항</a>
    <a href="../book/recommend.php">도서추천</a>
    <a href="../board/bd_list.php">자유게시판</a>
    </div>
    
    <div class="header_right">
<?php
require 'loginchk.php';
if($chk_login) {
    switch ($_SESSION['mem_id']) {
        case 'admin':
    ?>
            <a href="../manage/admin.php">관리자모드</a>
            <a href="/membership/mem_logout.php">로그아웃</a>
    <?php
            break;
        default:
    ?>
            <div class="drop_menu">
            <button>회원메뉴<i class="fa fa-caret-down"></i></button>
            <div class="column">
                <a href="../membership/mypage.php?id=<?=$_SESSION['mem_id']?>">마이페이지</a>
                <a href="../membership/mem_update.php?id=<?= $_SESSION['mem_id']?>">회원정보수정</a>
                <a href="../order/cart_list.php">장바구니</a>
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