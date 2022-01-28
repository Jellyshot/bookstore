<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
    require_once '../utility/loginchk.php';

    $upload_path = './profile/';
    $stmt = "SELECT * FROM membership WHERE mem_id =".$_SESSION['mem_id'];
    $stmt = $conn->query($stmt);
    $row = $stmt->fetch_assoc();
?>

    <h1>회원정보 수정</h1>
    <form action="mem_updateProcess.php" method="POST" enctype="multipart/form-data" class = "r_container">
        <div class="r_info">
            
            <p>아이디</p><br> 
            <!-- id값을 js에서 다루어야 하기 때문에 id input에 id값을 준다 -->
            <input type="text" id="mem_id" name="mem_id" value="<?= $row['mem_id'] ?>" readonly/><br>
            <!-- 비밀번호는 일치를 확인해야 하므로 따로 프로세스 처리함 -->
            <p>비밀번호</p>
            <a href="./mem_pwdchange.php">비밀번호 변경</a>
            <p>이름</p>
            <input type="text" name="mem_name" value="<?= $row['mem_name'] ?>" required/><br>
            <p>주소</p>
            <input type="text" name="mem_address" value="<?= $row['mem_address'] ?>"/><br>
            <p>전화번호</p>
            <input type="tell" name="mem_phone" maxlength="11" value="<?= $row['mem_phone'] ?>" required/><br>
            <p>이메일</p>
            <input type="email" name="mem_email" value="<?= $row['mem_email'] ?>"/><br>
            <div class="profilechk">
            <p>프로필이미지</p>
            <img src="<?= $upload_path.$row['mem_profile']?>" alt="Image">
            <input type="file" name="mem_profile" value="<?= $row['mem_profile'] ?>"/><br>
            </div>
        </div>
        <div class="r_button">
            <input type="submit" value="수정"/>
            <input type="button" value="취소" onclick="history.back()"/>
        </div>
    </form>

    <script defer src="../js/idcheck.js"></script>
</body>
</html>