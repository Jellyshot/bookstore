<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
?>


    <form action="mem_registProcess.php" method="POST" enctype="multipart/form-data" class = "r_container">
        <div class="r_info">
            <!-- id 중복확인을 하기 위한 button에 checkid function 추가 -->
            <p>아이디</p><br> 
            <button onclick="checkid()">아이디 중복확인</button>
            <!-- id값을 js에서 다루어야 하기 때문에 id input에 id값을 준다 -->
            <input type="text" id="mem_id" name="mem_id" required/><br>
            <p>비밀번호</p>
            <input type="password" name="mem_pwd" required/><br>
            <p>비밀번호 확인</p>
            <input type="password" name="mem_cpwd"  required/><br>
            <p>이름</p>
            <input type="text" name="mem_name" required/><br>
            <p>주소</p>
            <input type="text" name="mem_address"/><br>
            <p>전화번호</p>
            <input type="tell" name="mem_phone" maxlength="11" required/><br>
            <p>이메일</p>
            <input type="email" name="mem_email"/><br>
            <p>프로필이미지</p>
            <input type="file" name="mem_profile"/><br>
        </div>
        <div class="r_button">
            <input type="submit" value="가입"/>
            <input type="button" value="취소"/>
        </div>
    </form>

    <script defer src="../js/idcheck.js"></script>
</body>
</html>