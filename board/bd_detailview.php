<!-- 공지사항 상세페이지 -->
<?php
require '../utility/dbconfig.php';
require '../utility/nav.php';
require_once '../utility/loginchk.php';

$bd_code = $_GET['bd_code'];
$upload_path = './bd_upload/';

$sql = "SELECT * FROM board WHERE bd_code ='". $bd_code."'";
$sql = $conn->query($sql);
$row = $sql->fetch_assoc();
?>

<script defer src="../js/comment_update.js"></script>

<h1>자유게시판 상세페이지</h1>
<hr style="width: 80%; margin:auto;">
<div class="n_buttons">
    <a href="./bd_list.php">목록으로</a>
    <?php
    if (isset($_SESSION['mem_id']) && $_SESSION['mem_id'] != '' && $_SESSION['mem_id'] == $row['mem_id']) {
    ?>
        <a href="./bd_update.php?bd_code=<?=$bd_code?>">수정</a>
        <a href="./bd_deleteProcess.php?bd_code=<?=$bd_code?>">삭제</a>
    <?php
    }
    echo "</div>";

    if ($sql->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th style="width: 20%;">제목</th>
                <td style="width: 80%;"><?= $row['bd_subject'] ?></td>
            </tr>
            <tr>
                <th style="width: 20%;">작성자</th>
                <td style="width: 80%;"><?= $row['mem_id'] ?></td>
            </tr>
            <tr>
                <td colspan="2">
    
<?php     if (isset($row['bd_upload']) && ($row['bd_upload'] != "")) {
?>
                    <img src="<?=$upload_path?><?= $row['bd_upload'] ?>" alt="no image" style="margin: 10px;" ><br>
<?php       }       
?>                   <p style="margin: 10px;"><?= $row['bd_contents'] ?></p>
                </td>
            </tr>
            <tr>
                <th>첨부파일</th><td><?= $row['bd_upload'] ?></td>
            </tr>
        </table>
<?php
    if($chk_login){
?>
    <!-- 댓글창 시작 -->
    <!-- 1. form을 통한 댓글 입력 영역 -->
    <div class="width80">
    <form action="./comment_insertProcess.php" method="POST" class="writeform" style="display:flex;">
        <input type="hidden" name="bd_code" value="<?=$bd_code?>"/>
        <input type="hidden" name="cmt_writer" value="<?=$_SESSION['mem_id']?>"><br>
        <input type="text" name="cmt_contents" placeholder="댓글을 작성해 주세요." style="width: 98%;">
        <input type="submit" value="저장" style="margin: 16px auto;" >
    </form>
    </div>
    <br>

    <!-- 2. 댓글 Read 영역 생성: 조건 = bd_code에 맞는 댓글만 불러옴 -->
    <div class="comment_view">
<?php
    }//end of $chk_login
    // 해당 게시물의 전체 댓글 수 조회
    //  $stmt = mysqli_query($conn,"SELECT COUNT(*) AS cmt_recods FROM bd_comments WHERE bd_code=".$bd_code);
    $sql = "SELECT COUNT(*) AS cmt_recods FROM bd_comment WHERE bd_code= ".$bd_code;
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cmt_recods = $row['cmt_recods'];
    }else {
        $cmt_recods = 0;
    }
?>  <div class="width80">
    <p>전체 댓글 수 &#91; <?=$cmt_recods?> &#93;</p>
    
<?php
    if($cmt_recods != 0 ) {
        $sql = "SELECT * FROM bd_comment WHERE bd_code =".$bd_code;
        $resultset = $conn->query($sql);
        while ($row = $resultset->fetch_assoc()) {
?>          <div class="comment_box" id="c_d_display<?=$row['cmt_code']?>">
                <hr>
                <div class="each_comment">
                    <p><?=$row['cmt_writer']?> &nbsp;&nbsp; <?=$row['cmt_udate']?></p>
                    <p><?=$row['cmt_contents']?></p>
                </div>

                <!-- 댓글을 뿌려줄건데, 수정 삭제버튼은 작성자와 로그인한 session값이 같을때만 나타내기 -->
<?php           if ($chk_login==TRUE &&$_SESSION['mem_id'] == $row['cmt_writer']) {
?>                  <div class="comment_buttons textalign_center">
                    <!-- 자바스크립트를 수정버튼에 심음 -->
                    <a onclick="arah(<?=$row['cmt_code']?>)">수정</a>
                    <a href="../board/comment_deleteProcess.php?cmt_code=<?=$row['cmt_code']?>&bd_code=<?=$row['bd_code']?>">삭제</a>
                    </div>
                </div> 

                <!-- 댓글 수정 폼 작성 -->
                <div class="c_update" id="c_d_hide<?=$row['cmt_code']?>">
                    <form action="./comment_updateProcess.php" method="POST">
                        
                        <input type="hidden" name="bd_code" value="<?=$bd_code?>">
                        <input type="hidden" name="cmt_code" value="<?=$row['cmt_code']?>">
                        <input type="text" name="cmt_writer" value="<?=$_SESSION['mem_id']?>" style="border:none;"><br>
                        <input type="text" name="cmt_contents" placeholder="댓글을 작성해 주세요." style="width: 98%;">
                        <div class="textalign_center">
                        <input type="submit" value="저장">
                        <input type="button" value="취소" onclick="arah(<?=$row['cmt_code']?>)">
                        </div>
                    </form>
                </div>
<?php    
            }//댓글수정 
        }//end of while
    }// end of if($cnt_recods !=0 )
    
?>
    </div>

    <?php
        $conn->close();
        // $sql->close();
        // $stmt->close();
    } else {
    ?>
        <script>
            alert("잘못된 요청입니다");
            location.href = './bd_list.php';
        </script>

    <?php
    }
    ?>
    </body>

    </html>