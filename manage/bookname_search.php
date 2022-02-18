<?php

require '../utility/dbconfig.php';

?>
<script defer src="../js/setValues.js"></script>

<h3>작가검색</h3>
<form name="sform" method="POST" action="./bookname_search.php">
        <input type="text" name="aut_search" placeho<?php

require '../utility/dbconfig.php';

?>
<script defer src="../js/setValues.js"></script>

<h3>작가검색</h3>
<form name="sform" method="POST" action="./bookname_search.php">
        <input type="text" name="aut_search" placeholder="작가명을입력하세요">
        <input type="submit" value="검색"><br>
        <!-- <input type="submit" onclick="setValues()" value="입력하기">  -->
</form>

<?php
if (isset($_POST['aut_search'])) {
        $aut_search = $_POST['aut_search'];

        $sql = "SELECT aut_code, aut_name FROM author WHERE aut_name like '%" . $aut_search . "%'";
        $result = $conn->query($sql);
?>
        <!-- <form action=""> -->
        <table>
                <tr>
                        <th>작가코드</th>
                        <th>작가이름</th>
                </tr>

                <?php
                while ($row = $result->fetch_assoc()) {
                ?> <tr>
                        <td>
							<input type="radio"  id="cInput" name="aut_code" value="<?= $row['aut_code'] ?>">
                        </td>
                        <td><?= $row['aut_name'] ?></td>
                        </tr>
                <?php
                }
                ?>
        </table>
        <!-- <input type="button" onclick="setValues()" value="선택하기" style="border:none; font-size:16px;"> -->
        <a onclick="setValues()" style="border:none; font-size:16px;">선택하기</a>
        <!-- </form> -->

<?php
}
?>lder="작가명을입력하세요">
        <input type="submit" value="검색"><br>
        <!-- <input type="submit" onclick="setValues()" value="입력하기">  -->
</form>

<?php
if (isset($_POST['aut_search'])) {
        $aut_search = $_POST['aut_search'];

        $sql = "SELECT aut_code, aut_name FROM author WHERE aut_name like '%" . $aut_search . "%'";
        $result = $conn->query($sql);
?>
        <!-- <form action=""> -->
        <table>
                <tr>
                        <th>작가코드</th>
                        <th>작가이름</th>
                </tr>

                <?php
                while ($row = $result->fetch_assoc()) {
                ?> <tr>
                        <td>
							<input type="radio"  id="cInput" name="aut_code" value="<?= $row['aut_code'] ?>">
                        </td>
                        <td><?= $row['aut_name'] ?></td>
                        </tr>
                <?php
                }
                ?>
        </table>
        <!-- <input type="button" onclick="setValues()" value="선택하기" style="border:none; font-size:16px;"> -->
        <a onclick="setValues()" style="border:none; font-size:16px;">선택하기</a>
        <!-- </form> -->

<?php
}
?>