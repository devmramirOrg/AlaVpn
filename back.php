<?php

//-------------------------
// Dev : @DevMrAmir
// Channel : @LintoCode
//-------------------------


// ------- Include -------
include '../config.php';

// ------- Get -------
$Authority = $_GET['Authority'];
$user = $_GET['id'];
$amount = $_GET['amount'];

$data = array("merchant_id" => "$MerchantID", "authority" => $Authority, "amount" => $amount);
$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result, true);
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    if ($result['data']['code'] == 100) {
        
        
$sql    = "SELECT `coin` FROM `users` WHERE `id`=$user";
$result2 = mysqli_query($conn,$sql);

$res = implode(mysqli_fetch_assoc($result2));
        
$ok = $res + $amount;

$sql_new = "UPDATE `users` SET coin=$ok WHERE id=$user";
mysqli_query($conn,$sql_new);

bot('sendMessage',[
                        'chat_id'=>$user,
                        'text'=>"✅ پرداخت شما با موفقیت انجام شد و موجودی شما اضافه شد",
                        'parse_mode'=>"HTML",
                        'reply_markup'=>json_encode([
                        'inline_keyboard'=>[
                        [
                            [ 'text' => "💳 مبلغ پرداختی"   , 'callback_data' => "DevMrAmir" ] ,
                            [ 'text' => "$amount"   , 'callback_data' => "DevMrAmir" ]
                        ],
                        ]
                        ])
                        ]);
                        
bot('sendMessage',[
                        'chat_id'=>$chanSef,
                        'text'=>"✅ پرداخت جدید در ربات انجام شد",
                        'parse_mode'=>"HTML",
                        'reply_markup'=>json_encode([
                        'inline_keyboard'=>[
                        [
                            [ 'text' => "💳 مبلغ پرداختی"   , 'callback_data' => "DevMrAmir" ] ,
                            [ 'text' => "$amount"   , 'callback_data' => "DevMrAmir" ]
                        ],
                        [
                            [ 'text' => "👤 شناسه کاربر"   , 'callback_data' => "DevMrAmir" ] ,
                            [ 'text' => "$user"   , 'callback_data' => "DevMrAmir" ]
                        ],
                        ]
                        ])
                        ]);

    } else {
        
    bot('sendMessage',[
                        'chat_id'=>$user,
                        'text'=>"❌ پرداخت شما انجام نشد",
                        'parse_mode'=>"HTML",
                        ]);
    }
}

?>