<?php
// db연결
$conn= new mysqli('localhost', 'root', '');

if(!$conn->connect_error){
    echo "<script>alert('DBMS와 연결이 설정되었습니다')</script>";
}else{
    echo "<script>alert('DBMS와 연결에 실패하였습니다')</script>";
}

// create DB
$dbname = 'bookstore';
$sql = "DROP DATABASE IF EXISTS ".$dbname;
$conn->query($sql);

$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
$conn->query($sql);

//사용자 계정 생성
$account = $dbname;
$sql = "DROP USER IF EXISTS ".$account;
$conn->query($sql);

$sql = "CREATE USER IF NOT EXISTS ".$account."'@'%' IDENTIFIED BY '".$account."'";
$conn->query($sql);

//계정의 리소스 제한
$sql = "GRANT USAGE ON *.* TO '".$account."'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTION 0";
$conn->query($sql);

//계정에 모든 권한 부여
$sql = "GRANT ALL PRIVILEGES ON `".$dbname."`.* TO '".$account."'@'%'";
$conn->query($sql);

//명시적으로 현재사용 DB 선언
$sql = "use ". $dbname;
$conn->query($sql);

//----------------------------------------------------------------


//--category 테이블 생성
$sql = "DROP TABLE IF EXISTS 'category'";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `".$dbname."`.`category` (
    `ctg_id` INT(8) NOT NULL AUTO_INCREMENT , 
    `ctg_name` VARCHAR(50) NOT NULL ,
    PRIMARY KEY (`ctg_id`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



//--book 테이블 생성
$sql = "DROP TABLE IF EXISTS 'publisher'";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `".$dbname."`.`publisher` (
    `pbs_id` INT(8) NOT NULL AUTO_INCREMENT , 
    `pbs_name` VARCHAR(50) NOT NULL , 
    `pbs_charge` VARCHAR(20) NULL , 
    `pbs_phone` VARCHAR(13) NOT NULL , 
    `pbs_email` VARCHAR(50) NOT NULL , 
    `pbs_address` VARCHAR(200) NULL , 
    `pbs_account` VARCHAR(20) NULL , 
    `pbs_pdate` DATE NOT NULL , 
    PRIMARY KEY (`pbs_id`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



//-- author 테이블 생성
$sql = "DROP TABLE IF EXISTS 'author'";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `".$dbname."`.`author` (
    `aut_id` INT(8) NOT NULL AUTO_INCREMENT , 
    `aut_name` VARCHAR(50) NOT NULL , 
    `ctg_id` INT(8) NOT NULL , 
    `aut_masterpiece` VARCHAR(50) NOT NULL , 
    `aut_interview` VARCHAR(200) NULL , 
    `aut_birth` DATE NOT NULL , 
    `aut_upload` VARCHAR(200) NULL ,
    PRIMARY KEY (`aut_id`),
    FOREIGN KEY (`ctg_id`)
    REFERENCES `category`(`ctg_id`) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



//-- book 테이블 생성
$sql = "DROP TABLE IF EXISTS 'book'";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `".$dbname."`.`book` (
    `book_id` INT(8) NOT NULL AUTO_INCREMENT , 
    `book_name` VARCHAR(20) NOT NULL , 
    `ctg_id` INT(8) NOT NULL , 
    `aut_id` INT(8) NOT NULL , 
    `pbs_id` INT(8) NOT NULL ,
    `book_info` VARCHAR(200) NULL , 
    `book_stock` INT(6) NOT NULL , 
    `book_price` INT(8) NOT NULL ,
    `book_pdate` DATE NOT NULL ,
    `book_upload` VARCHAR(200) NULL ,
    PRIMARY KEY (`book_id`),
    FOREIGN KEY (`ctg_id`)
    REFERENCES `category`(`ctg_id`) ON UPDATE CASCADE ON DELETE CASCADE ,
    FOREIGN KEY (`aut_id`)
    REFERENCES `author`(`aut_id`) ON UPDATE CASCADE ON DELETE CASCADE ,
    FOREIGN KEY (`pbs_id`)
    REFERENCES `publisher`(`pbs_id`) ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



// -- admin 테이블 생성
$sql = "DROP TABLE IF EXISTS 'admin'";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `admin` (
    `adm_code` INT(8) NOT NULL AUTO_INCREMENT ,
    `adm_id` VARCHAR(20) NOT NULL ,
    `adm_pwd` VARCHAR(20) NOT NULL ,
    PRIMARY KEY (`adm_code`) 
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



// --notice 테이블 생성
$sql = "DROP TABLE IF EXISTS 'notice'";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `notice`(
    `ntc_id` INT(8) NOT NULL AUTO_INCREMENT ,
    `ntc_subject` VARCHAR(50) NOT NULL ,
    `ntc_contents` VARCHAR(2000) NOT NULL ,
    `adm_code` INT(8) NOT NULL ,
    `ntc_writetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTEMP ,
    `ntc_upload` VARCHAR(200) NULL
    PRIMARY KEY (`ntc_id`) ,
    FOREIGN KEY (`adm_code`) REFERENCES `admin` (`adm_code`) ON DELETE CACADE
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



// --membership 테이블 생성
$sql = "DROP TABLE IF EXISTS 'membership'";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS `mebership`(
    `mem_code` INT(8) NOT NULL AUTO_INCREMENT ,
    `mem_id` VARCHAR(20) NOT NULL UIQUE,
    `mem_pwd` VARCHAR(20) NOT NULL ,
    `mem_name` VARCHAR(24) NOT NULL ,
    `mem_address` VARCHAR(200) NULL ,
    `mem_phone` VARCHAR(13) NOT NULL ,
    `mem_email` VARCHAR(50) NULL ,
    `mem_joindate` DATETIME NOT NULL 
    `mem_profile` VARCHAR(200) NULL
    PRIMARY KEY (`mem_cod`) 
    )ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci";
$conn->query($sql);



// -- messege 테이블 생성
$sql = "DROP TABLE IF EXISTS 'messege'";
$conn->query($sql);

$sql="CREATE TABLE IF NOT EXISTS `messege`(
    `msg_id` INT(8) NOT NULL AUTO_INCREMENT ,
    `sent_mem_code` INT(8) NOT NULL ,
    `rec_mem_code` INT(8) NOT NULL ,
    `msg_sentdate` DATETIME NOT NULL ,
    `msg_subject` VARCHAR(20) NOT NULL ,
    `msg_contents` VARCHAR(200) NOT NULL ,
    PRIMARY KEY (`msg_id`) ,
    FOREIGN KEY (`sent_mem_code`) REFERENCES `membership` (`mem_code`) ON DELETE CASCADE ,
    FOREIGN KEY (`rec_mem_code`) REFERENCES `membership` (`mem_code`) ON DELETE CASCADE 
)ENGINE = InnoDB CAHRSET=utf8 COLLATE utf9_general_ci";
$conn->query($sql);




//--- 테이블 생성이 모두 완료 후 리소스 반납

if ($conn != null) {
    $conn->close();
    echo "<script>alert('DBMS와 연결을 종료합니다.')</script>";
}

?>