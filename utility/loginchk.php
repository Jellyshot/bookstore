<?php
    session_start();
    if (isset($_SESSION['mem_id'])) {
        $chk_login = TRUE;
    }else{
        $chk_login = FALSE;
    }
?>