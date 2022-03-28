<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';
?>

<script defer src="../js/join_chk.js"></script>
<script defer src="../js/idcheck.js"></script>
    <h1>회원가입</h1>
    <div class="width80">
        <hr>
    </div>
    <form action="mem_registProcess.php" method="POST" enctype="multipart/form-data" class ="r_container" name="join_form" id="join_form">
        <div class="r_info">
            <!-- id 중복확인을 하기 위한 button에 checkid function 추가 -->
            <p>아이디</p>
            <button onclick="checkid()">아이디 중복확인</button>
            <!-- id값을 js에서 다루어야 하기 때문에 id input에 id값을 준다 -->
            <input type="text" id="mem_id" name="mem_id" required/><br>
            <p><font style="color:red;">*아이디는 대소영문자와 숫자로 입력해주세요</font></p>   
            <p>비밀번호</p>
            <input type="password" name="mem_pwd" id="mem_pwd"required/><br>
            <p>비밀번호 확인</p>
            <input type="password" name="mem_cpwd" id="mem_cpwd" required/><br>
            <p>이름</p>
            <input type="text" name="mem_name" id="mem_name" required/><br>
            <p>전화번호(숫자만 입력)</p>
            <input type="tell" name="mem_phone" id="mem_phone" maxlength="11" required/><br>
            <p>주소</p>
            <input type="text" name="mem_address" id="mem_address"/><br>
            <p>이메일</p>
            <input type="email" name="mem_email" id="mem_email" /><br>
            <p>프로필이미지</p>
            <input type="file" name="mem_profile"/><br>
        </div>
        <div class="r_button">
            <input type="button" value="가입" onclick="join_chk()"/>
            <input type="button" value="취소" onclick="history.back()"/>
            <!-- https://goddino.tistory.com/52 아니 이거보고 하는데 왜 안댐 ㅠㅠㅠㅠㅠㅠㅠㅠㅠㅠ! -->
        </div>
    </form>

</body>
</html>