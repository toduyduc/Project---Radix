<?php
if(!defined("_INCODE")) die("unauthorized access...");
try{
    if(class_exists("PDO")){
        $dsn = _DRIVER.":dbname="._DB.";host="._HOST;
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', //Set utf8
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Tạo thông báo ra ngoại lệ khi gặp lỗi truy vấn
            ];
        $conn = new PDO($dsn, _USER, _PASS,$options);
    }
} catch (Exception $exception){   //exception (english) : ngoại lệ
    require_once "modules/errors/database.php";
    // echo '<div style="color: red;border:1px solid red; padding:5px 15px;">';
    // echo $exception->getMessage().'<br>';
    // echo '</div>';
    die();
}