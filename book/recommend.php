<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';

$upload_path = './book_upload/';

$sql = "select book_code, book_name, aut_name, book_price from book 
        INNER JOIN author ON author.aut_code = book.book_code
        order by rand() limit 8";
$resultset = $conn->query($sql);
?>
    <h1>추천도서</h1>
<div class="width80">
    <h2 style="color:#4a4737;">"좋은 책을 읽는 것은 지난 몇 세기에 걸쳐 가장 훌륭한 사람들과 대화 하는 것과 같다." &nbsp;&nbsp;<데카르트></h2>
    <hr style="background-color: #4c3a00; height: 3px;">
</div>
    <div class="cardList">
<?php
        while ($row = $resultset->fetch_array()) {
?>
        <div class="bookcard">
<?php
            if(isset($row['book_upload'])&&($row['book_upload']!="")){ ?>
            <img src="<?=$upload_path?><?=$row['book_upload']?>" alt="이미지 준비중" style="width:100%">
<?php        }else{ ?>
            <img src="../img/cover1.jpg" alt="이미지오류" style="width: 100%;">
<?php       }   ?>
            <h2><?=$row['book_name']?></h2>
            <p class="price"><?=$row['book_price']?>원</p>
            <p><?=$row['aut_name']?> 지음</p>   
            <p><button><a href="./book_detailview.php?book_code=<?=$row['book_code']?>">보러가기</a></button></p>
        </div>
<?php
        }
?>
    </div>
</body>

</html>