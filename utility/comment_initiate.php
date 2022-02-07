<?php
require '../utility/dbconfig.php';

$sql = "DROP TABLE IF EXISTS bd_comment";
$conn->query($sql);

$sql = "CREATE TABLE `bd_comment`(
    `cmt_code` INT(8) NOT NULL AUTO_INCREMENT,
    `cmt_writer` VARCHAR(20) NOT NULL,
    `bd_code` INT(8) NOT NULL,
    `cmt_contents` VARCHAR(200) NOT NULL,
    `cmt_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(`cmt_code`),
    FOREIGN KEY(`cmt_writer`) REFERENCES `membership` (`mem_id`) ON DELETE CASCADE,
    FOREIGN KEY(`bd_code`) REFERENCES `board`(`bd_code`) ON DELETE CASCADE
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


?>