<?php

//-------------------------
// Dev : @DevMrAmir
// Channel : @AlaCode
//-------------------------

//------- Sql DataBase -------
$serverName = "localhost"; // ادیت نشود
$db_name    = "name"; // نام دیتابیس
$db_user    = "user"; // یوزر دیتابیس
$db_pass    = "passWord"; // پسورد دیتابیس

$conn = mysqli_connect($serverName, $db_user, $db_pass, $db_name);

if(!$conn){

    die('failed ' . mysqli_connect_error());
}
//------- Data -------
$token        = "token"; // توکن ربات
$admin        = "544316811"; // عددی ادمین
$vpnname      = "الا وی پی ان"; // اسم شرکت
$bot_id       = "AlaVpnBot"; //ایدی ربات
$tronW        = "تست"; // کیف پول ترون
$cart         = "تست"; // شماره کارت
$gig25        = 1; // قیمت سرور 25 گیگ
$gig40        = 1; // قیمت سرور 40 گیگ
$gig60        = 1; // قیمت سرور 60 گیگ
$gig100       = 1; // قیمت سرور 100 گیگ
$gig150       = 1; // قیمت سرور 150 گیگ
$gig200       = 1; // قیمت سرور 200 گیگ
$chanSef      = "-1001583024952"; // ایدی عددی چنل سفارشات
$MerchantID   = ""; // مرچند درگاه زرین پال
$web          = "https://amirhosin.gigapanel.xyz/vpnPro"; // ادرس دامنه سورس با پوشه

$sql2    = "SELECT `chanel` FROM `Settings`";
$result2 = mysqli_query($conn,$sql2);
$res2 = mysqli_fetch_assoc($result2);
$channel_bot  = $res2['chanel'];
//------- Function -------
    
    function bot($method, $user = []){
        global $token;
    $url = "https://api.telegram.org/bot$token"."/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $user);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

?>