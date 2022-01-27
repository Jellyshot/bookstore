
<?php
    require '../utility/nav.php';
?>
<div class="login_container">
<p><h2>로그인</h2></p>
<hr>
<br>
<form action="mem_loginProcess.php" method="POST" class="login_box">
    <input type="text" name="mem_id" placeholder="아이디"><br>
    <input type="password" name="mem_pwd" placeholder="비밀번호"><br>
    <input type="submit" value="로그인" class="login_button"><br>
</form>
</div>
</body>
</html>