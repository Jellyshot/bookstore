<?php
    require '../utility/dbconfig.php';
    require '../utility/nav.php';

    if (isset($_SESSION['mem_id']) && $_SESSION['mem_id'] != '' && $_SESSION['mem_id'] == 'admin') {
?>
    <aside>
        <a href="./admin.php">도서관리</a>
        <a href="./manage_publisher.php">거래처관리</a>
        <a href="./manage_author.php">작가정보관리</a>
        <a href="./manage_member.php">회원관리</a>
        <a href="./manage_order.php">주문관리</a>
    </aside>
    <main>
        <h1>작가관리 페이지 입니다.</h1>
        <a href="">작가추가</a>
        <table>

        </table>
    </main>

<?php
    }
?>
</body>
</html>