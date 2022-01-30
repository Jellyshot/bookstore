<?php
// 1.로그인시 세션을 사용하기 위해 최 상단에 session start를 해줌.
session_start();

// 2. 데이터 베이스 연결 후
require_once '../utility/dbconfig.php';

// 3. loing.php 입력값 받아오기
$mem_id = $_REQUEST['mem_id'];
$mem_pwd = $_REQUEST['mem_pwd'];

// 4. 사용자 계정 존재 여부 확인 후 결과값을 $row에 저장시키기
$stmt = $conn->prepare("SELECT * FROM membership WHERE mem_id = ? and mem_pwd = sha2(?,256)");
$stmt->bind_param("ss", $mem_id, $mem_pwd);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_array($result);

// 5. 사용자 계정이 등록되어있는것이 확인되면 성공메세지 띄우고 세션 생성
if (!empty($row['mem_id'])) {
    $_SESSION['mem_id'] = $mem_id;
    $conn->close();
    header('Location: ./mypage.php?id='.$mem_id);
}
    // 계정이 확인되지 않을 경우 홈화면으로 돌려준다.
else { ?>
    <script>
    alert("로그인에 실패하였습니다.");
    location.href="../index.php";
    </script>
<?php }$conn->close();
?>