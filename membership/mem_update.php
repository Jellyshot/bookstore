<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

    $upload_path = './profile/';
    $stmt = "SELECT * FROM membership WHERE mem_id ='".$_SESSION['mem_id']."'";
    $stmt = $conn->query($stmt);
    $row = $stmt->fetch_assoc();
?>
<script defer src="../js/join_chk.js"></script>

    <h1>회원정보 수정</h1>
    <div class="width80">
        <hr>
    </div>
    <form action="mem_updateProcess.php" method="POST" enctype="multipart/form-data" class = "r_container" name="join_form">
        <div class="r_info">
            
            <!-- id값을 js에서 다루어야 하기 때문에 id input에 id값을 준다 -->
            <input type="hidden" id="mem_id" name="mem_id" id="mem_id" value="<?= $row['mem_id'] ?>" readonly/><br>
            <p>비밀번호</p>
            <input type="password" name="mem_pwd" id="mem_pwd" value="<?= $row['mem_pwd'] ?>" required/><br>
            <p>비밀번호 확인</p>
            <input type="password" name="mem_cpwd" id="mem_cpwd" value="<?= $row['mem_pwd']?>" required/><br>
            <p>이름</p>
            <input type="text" name="mem_name" id="mem_name" value="<?= $row['mem_name'] ?>" required/><br>
            <p>주소</p>
            <input type="text" name="mem_address" value="<?= $row['mem_address'] ?>"/><br>
            <p>전화번호</p>
            <input type="tell" name="mem_phone" id="mem_phone" maxlength="11" value="<?= $row['mem_phone'] ?>" required/><br>
            <p>이메일</p>
            <input type="email" name="mem_email" value="<?= $row['mem_email'] ?>"/><br>
            <div class="profilechk">
            <p>프로필이미지</p>
            <input type="file" name="mem_profile" value="<?= $row['mem_profile'] ?>"/><br>
            </div>
        </div>
        <div class="r_button">
            <input type="button" value="수정" onclick="join_chk()"/>
            <input type="button" value="취소" onclick="history.back()"/>
        </div>
    </form>

</body>
</html>