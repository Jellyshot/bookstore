<?php
    // 1. db연결
    require '../utility/dbconfig.php';
    $aut_name = $_POST['aut_search'];


    $sql="SELECT aut_code FROM author WHERE aut_name like '%".$search."%'";
?>