<?php

date_default_timezone_set('Asia/Tehran');
$date = date('Y/m/d');
include("config.php");

$sql    = "SELECT * FROM `Bought`";
$result = mysqli_query($conn,$sql);
 
 while($row = mysqli_fetch_assoc($result)){
        
    $date_off = $row['date'];
    $id       = $row['Owner'];
    $code     = $row['code'];
    $contry   = $row['contry'];

    if($date_off == $date){
        
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"🔁 تمدید یک سرویس امده است

👤 مالک سرویس : $id
🔑 کلید : $code
📲 کشور : $contry",
'parse_mode'=>"HTML",
]);

bot('sendMessage',[
'chat_id'=>$id,
'text'=>"❌ تمدید سرویستون رسیده

🔑 کلید : $code
📱 کشور : $contry

❤️ برید قسمت شارژ حساب مبلغ را واریز کنید و زیر رسید توضیحات که برای تمدید سرویس هست را ارسال کنید",
'parse_mode'=>"HTML",
]);
        
    }
}

?>