<?php

//-------------------------
// Dev     : @DevMrAmir
// Channel : @AlaCode
//-------------------------

// ------- Sql Code -------
include("config.php");

mysqli_multi_query(
    $conn,
    "CREATE TABLE `users` (
        `id` bigint PRIMARY KEY,
        `step` varchar(20),
        `ref` bigint(20),
        `coin` bigint,
        `phone` bigint,
        `account` text
        ) default charset = utf8mb4;
        CREATE TABLE `vpn` (
        `id` bigint PRIMARY KEY,
        `code` text,
        `hajm` varchar(20),
        `contry` text
        ) default charset = utf8mb4;
        CREATE TABLE `Bought` (
        `id` bigint PRIMARY KEY,
        `code` text,
        `contry` text,
        `Owner` bigint,
        `date` text
        ) default charset = utf8mb4;
        CREATE TABLE `moton` (
        `tarfe` text,
        `android` text,
        `windows` text,
        `ios` text,
        `mac` text,
        `linux` text,
        `help` text
        ) default charset = utf8mb4;
        CREATE TABLE `Settings` (
        `bot` text,
        `pay` text,
        `sharj` text,
        `support` text,
        `chanel` text
        ) default charset = utf8mb4;");
    if(mysqli_connect_errno()){
    echo "به دلیل مشکل زیر، اتصال برقرار نشد : <br />" . mysqli_connect_error();
    die();
}else{
echo "دیتابیس متصل و نصب شد .";

            
            
            
            
            
}

?>