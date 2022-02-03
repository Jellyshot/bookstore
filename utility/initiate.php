<?php
require './utility.php';
// db연결
$conn= new mysqli('localhost', 'root', '');

if(!$conn->connect_error){
    echo "<script>alert('DBMS와 연결이 설정되었습니다')</script>";
}else{
    echo "<script>alert('DBMS와 연결에 실패하였습니다')</script>";
}

// create DB
$dbname = 'bookweb';
$sql = "DROP DATABASE IF EXISTS ".$dbname;
$conn->query($sql);

$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
$conn->query($sql);

// 사용자 계정 생성
$account = $dbname;
$sql = "DROP USER IF EXISTS ".$account;
$conn->query($sql);

$sql = "CREATE USER IF NOT EXISTS ".$account."'@'%' IDENTIFIED BY '".$account."'";
$conn->query($sql);

// //계정의 리소스 제한
$sql = "GRANT USAGE ON *.* TO '".$account."'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTION 0";
$conn->query($sql);

// //계정에 모든 권한 부여
$sql = "GRANT ALL PRIVILEGES ON `".$dbname."`.* TO '".$account."'@'%'";
$conn->query($sql);

//명시적으로 현재사용 DB 선언
$sql = "use ". $dbname;
$conn->query($sql);

//----------------------------------------------------------------


//--category 테이블 생성
$sql = "DROP TABLE IF EXISTS category";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS category (
    `ctg_code` INT(8) NOT NULL AUTO_INCREMENT , 
    `ctg_name` VARCHAR(50) NOT NULL ,
    PRIMARY KEY (`ctg_code`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



//--publisher 테이블 생성
$sql = "DROP TABLE IF EXISTS publisher";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS publisher (
    `pbs_code` INT(8) NOT NULL AUTO_INCREMENT , 
    `pbs_name` VARCHAR(50) NOT NULL , 
    `pbs_charge` VARCHAR(20) NULL , 
    `pbs_phone` VARCHAR(13) NOT NULL , 
    `pbs_email` VARCHAR(50) NOT NULL , 
    `pbs_address` VARCHAR(200) NULL , 
    `pbs_account` VARCHAR(20) NULL , 
    `pbs_pdate` VARCHAR(10) NOT NULL , 
    `pbs_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `pbs_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`pbs_code`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


//-- author 테이블 생성
$sql = "DROP TABLE IF EXISTS author";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS author (
    `aut_code` INT(8) NOT NULL AUTO_INCREMENT ,
    `aut_name` VARCHAR(50) NOT NULL ,
    `aut_interview` VARCHAR(200) NULL ,
    `aut_birth` DATE NULL , 
    `aut_upload` VARCHAR(200) NULL ,
    PRIMARY KEY (`aut_code`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


//-- book 테이블 생성
$sql = "DROP TABLE IF EXISTS book";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS book (
    `book_code` INT(8) NOT NULL AUTO_INCREMENT , 
    `book_name` VARCHAR(20) NOT NULL , 
    `ctg_code` INT(8) NOT NULL , 
    `aut_code` INT(8) NOT NULL , 
    `pbs_code` INT(8) NOT NULL ,
    `book_info` VARCHAR(200) NULL , 
    `book_cost` INT NOT NULL , 
    `book_price` INT NOT NULL ,
    `book_pdate` DATE NULL ,
    `book_upload` VARCHAR(200) NULL ,
    PRIMARY KEY (`book_code`),
    FOREIGN KEY (`ctg_code`)
    REFERENCES `category`(`ctg_code`) ON UPDATE CASCADE ON DELETE CASCADE ,
    FOREIGN KEY (`aut_code`)
    REFERENCES `author`(`aut_code`) ON UPDATE CASCADE ON DELETE CASCADE ,
    FOREIGN KEY (`pbs_code`)
    REFERENCES `publisher`(`pbs_code`) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


// --membership 테이블 생성
$sql = "DROP TABLE IF EXISTS membership";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS membership (
    `mem_id` VARCHAR(20) NOT NULL ,
    `mem_pwd` VARCHAR(500) NOT NULL ,
    `mem_name` VARCHAR(24) NOT NULL ,
    `mem_address` VARCHAR(200) NULL ,
    `mem_phone` VARCHAR(13) NOT NULL ,
    `mem_email` VARCHAR(50) NULL ,
    `mem_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `mem_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `mem_profile` VARCHAR(200) NULL ,
    PRIMARY KEY (`mem_id`) 
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


// --notice 테이블 생성
$sql = "DROP TABLE IF EXISTS notice";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS notice(
    `ntc_code` INT(8) NOT NULL AUTO_INCREMENT , 
    `ntc_subject` VARCHAR(20) NOT NULL ,
    `ntc_contents` TEXT NOT NULL ,
    `mem_id` VARCHAR(20) NOT NULL ,
    `ntc_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `ntc_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `ntc_upload` VARCHAR(200) NULL ,
    PRIMARY KEY (`ntc_code`) ,
    FOREIGN KEY(`mem_id`) REFERENCES `membership`(`mem_id`) ON DELETE CASCADE
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


// -- messege 테이블 생성
$sql = "DROP TABLE IF EXISTS messege";
$conn->query($sql);

$sql="CREATE TABLE IF NOT EXISTS `messege`(
    `msg_code` INT(8) NOT NULL AUTO_INCREMENT ,
    `sent_mem_id` VARCHAR(20) NOT NULL ,
    `rec_mem_id` VARCHAR(20) NOT NULL ,
    `msg_sentdate` DATETIME NOT NULL ,
    `mem_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `msg_contents` VARCHAR(200) NOT NULL ,
    PRIMARY KEY (`msg_code`) ,
    FOREIGN KEY (`sent_mem_id`) REFERENCES `membership` (`mem_id`) ON DELETE CASCADE ,
    FOREIGN KEY (`rec_mem_id`) REFERENCES `membership` (`mem_id`) ON DELETE CASCADE 
)ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


// -- board 테이블 생성
$sql = "DROP TABLE IF EXISTS board";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS board(
    `bd_code` INT(8) NOT NULL AUTO_INCREMENT,
    `mem_id` VARCHAR(20) NOT NULL ,
    `bd_subject` VARCHAR(50) NOT NULL ,
    `bd_contents` VARCHAR(2000) NOT NULL ,
    `bd_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `bd_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `bd_upload` VARCHAR(200) NULL ,
    PRIMARY KEY (`bd_code`) ,
    FOREIGN KEY(`mem_id`) REFERENCES `membership`(`mem_id`) ON DELETE CASCADE
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


//  ---------------------  주문관련 테이블 생성 --------------------
// cartmain
$sql = "DROP TABLE IF EXISTS cartmain";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS cartmain(
    `cm_code` INT(8) NOT NULL AUTO_INCREMENT ,
    `mem_id` VARCHAR(20) NOT NULL ,
    `cm_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `cm_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`cm_code`) ,
    FOREIGN KEY(`mem_id`) REFERENCES `membership`(`mem_id`) ON DELETE CASCADE
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);

// cartsub
$sql = "DROP TABLE IF EXISTS cartsub";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS cartsub(
    `cs_code` INT(8) NOT NULL AUTO_INCREMENT ,
    `cm_code` INT(8) NOT NULL ,
    `book_code` INT(8) NOT NULL ,
    `cs_cnt` INT(4) NOT NULL ,
    `cs_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `cs_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`cs_code`) ,
    FOREIGN KEY(`cm_code`) REFERENCES `cartmain`(`cm_code`) ON DELETE CASCADE ,
    FOREIGN KEY(`book_code`) REFERENCES `book`(`book_code`) ON DELETE CASCADE
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



// ordermain
$sql = "DROP TABLE IF EXISTS ordermain";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS ordermain(
    `om_code` INT(8) NOT NULL AUTO_INCREMENT ,
    `mem_id` VARCHAR(20) NOT NULL ,
    `om_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `om_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`om_code`) ,
    FOREIGN KEY(`mem_id`) REFERENCES `membership`(`mem_id`) ON DELETE CASCADE
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


// ordersub
$sql = "DROP TABLE IF EXISTS ordersub";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS ordersub(
    `os_code` INT(8) NOT NULL AUTO_INCREMENT ,
    `om_code` INT(8) NOT NULL ,
    `book_code` INT(8) NOT NULL ,
    `os_cnt` INT(4) NOT NULL ,
    `os_rdate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `os_udate` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`os_code`) ,
    FOREIGN KEY(`om_code`) REFERENCES `ordermain`(`om_code`) ON DELETE CASCADE ,
    FOREIGN KEY(`book_code`) REFERENCES `book`(`book_code`) ON DELETE CASCADE
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);


//--- 테이블 생성이 모두 완료 후 리소스 반납
if ($conn != null) {
    $conn->close();
    echo outmsg(DBMS_EXIT);
}
?>