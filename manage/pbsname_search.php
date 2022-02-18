<?php

require '../utility/dbconfig.php';

?>
<script defer src="../js/setValues.js"></script>

<h3>출판사검색</h3>
<form name="sform" method="POST" action="./pbsname_search.php">
        <input type="text" name="pbs_search" placeholder="출판사명을입력하세요">
        <input type="submit" value="검색"><br>
        <!-- <input type="submit" onclick="setValues()" value="입력하기">  -->
</form>

<?php
if (isset($_POST['pbs_search'])) {
        $pbs_search = $_POST['pbs_search'];

        $sql = "SELECT pbs_code, pbs_name FROM publisher WHERE pbs_name like '%" . $pbs_search . "%'";
        $result = $conn->query($sql);
?>
        <!-- <form action=""> -->
        <table>
                <tr>
                        <th>출판사코드</th>
                        <th>출판사이름</th>
                </tr>

                <?php
                while ($row = $result->fetch_assoc()) {
                ?> <tr>
                        <td>
							<input type="radio"  id="cInput2" name="pbs_code" value="<?= $row['pbs_code'] ?>">
                        </td>
                        <td><?= $row['pbs_name'] ?></td>
                        </tr>
                <?php
                }
                ?>
        </table>
        <!-- <input type="button" onclick="setValues()" value="선택하기" style="border:none; font-size:16px;"> -->
        <a onclick="setValues2()" style="border:none; font-size:16px;">선택하기</a>
        <!-- </form> -->

<?php
}
?>