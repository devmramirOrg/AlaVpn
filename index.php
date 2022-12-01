<?php
date_default_timezone_set('Asia/Tehran');
// ------- Telegram -------
$telegram_ip_ranges = [
    ['lower' => '149.154.160.0', 'upper' => '149.154.175.255'],
    ['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],
    ];
    $ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
    $ok=false;
    foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
    if(!$ok){
    $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
    $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
    if($ip_dec >= $lower_dec and $ip_dec <= $upper_dec){
    $ok=true;
    }}}
    if(!$ok){
    exit(header("location: https://coffemizban.com"));
    }

error_reporting(0);
$next = date('Y/m/d',strtotime('+30 day'));
// ------- include -------
include("config.php");
// ------- Telegram -------
$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)){
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$text = $update->message->text;
$first = $update->message->from->first_name;
$message_id = $update->message->message_id;
$phoneid = $update->message->contact->user_id;
}
if (isset($update->callback_query)){
$chat_id = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id2 = $update->callback_query->message->message_id;
}


function objectToArrays($object){
if(!is_object($object)and !is_array($object)){
return $object;
}
if(is_object($object)){
$object = get_object_vars($object);
}
return array_map("objectToArrays",$object);
}

$JsonInfo = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
$GetInfo = objectToArrays($JsonInfo);
$check = $GetInfo["ok"];
if(isset($check)){
$ur = $GetInfo["result"]["url"];

$lisens      = "amirhosin.gigapanel.xyz";
$text_licens = explode("/",$ur);
$urlSeet = $text_licens['2'];

if($urlSeet != $lisens){
    
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ دامنه ثبت شده اشتباه میباشد",
            'parse_mode'=>"HTML",
            ]);
        exit;
}
}

// Anti Code
if($chat_id != $admin){
    if(strpos($text, 'zip') !== false or strpos($text, 'ZIP') !== false or strpos($text, 'Zip') !== false or strpos($text, 'ZIp') !== false or strpos($text, 'zIP') !== false or strpos($text, 'ZipArchive') !== false or strpos($text, 'ZiP') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
        if(strpos($text, 'kajserver') !== false or strpos($text, 'update') !== false or strpos($text, 'UPDATE') !== false or strpos($text, 'Update') !== false or strpos($text, 'https://api') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
        if(strpos($text, '$') !== false or strpos($text, '{') !== false or strpos($text, '}') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
        if(strpos($text, '"') !== false or strpos($text, '(') !== false or strpos($text, '=') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
        if(strpos($text, 'getme') !== false or strpos($text, 'GetMe') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
    }

    if($text == "/start"){
    
        $sql    = "SELECT `id` FROM `users` WHERE `id`=$chat_id";
        $result = mysqli_query($conn,$sql);
        
        $res = mysqli_fetch_assoc($result);
        
        if(!$res){
            
            $sql2    = "INSERT INTO `users` (id, step, ref, coin, phone, account) VALUES ($chat_id, 'none', 0, 0, 0, 'ok')";
            $result2 = mysqli_query($conn,$sql2);
        }
        }
        
$sql_on_off    = "SELECT `bot` FROM `Settings`";
$result_on_off = mysqli_query($conn,$sql_on_off);
$res_on_off = mysqli_fetch_assoc($result_on_off);
$trsrul_on_off  = $res_on_off['bot'];

if($trsrul_on_off == "off" and $chat_id != $admin){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ ربات از طرف مدیریت خاموش میباشد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 کانال",'url'=>"https://t.me/$channel_bot?start"]],
]
])
]);
exit;
}

$sql_account    = "SELECT `account` FROM `users` WHERE `id`=$chat_id";
$result_account = mysqli_query($conn,$sql_account);
$res_account = mysqli_fetch_assoc($result_account);
$trsrul_account  = $res_account['account'];

if($trsrul_account == "ban"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ حساب شما از طرف مدیریت مسدود شده است",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 کانال",'url'=>"https://t.me/$channel_bot?start"]],
]
])
]);
exit;
}



if($channel_bot !="on"){
$forchaneel = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=@$channel_bot&user_id=".$chat_id));
$tch = $forchaneel->result->status;

        if($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍💻 سلام کاربر گرامی جهت استفاده از ربات درون کانال شما عضو شوید تا از اخرین اخبار ما با خبر باشید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 کانال",'url'=>"https://t.me/$channel_bot?start"]],
]
])
]);
exit();
}}

        $key1        = '👤 حساب کاربری';
        $key2        = '🛍 خرید سرویس';
        $key5        = '📲 سرویس های موجود';
        $key6        = '💵 تعرفه ها';
        $key7        = '☎️ پشتیبانی';
        $key8        = '🔑 راهنمای اتصال';
        $key9        = '📚 سوالات متداول';
        $pay         = '💳 خرید موجودی';

        $reply_keyboard = [
                                [$key1] ,
                                [$key5 , $key2] ,
                                [$key7 , $key6 , $pay] ,
                                [$key9 , $key8] ,
        
                              ];
         
            $reply_kb_options = [
                                    'keyboard'          => $reply_keyboard ,
                                    'resize_keyboard'   => true ,
                                    'one_time_keyboard' => false ,
                                ];

                                $key11          = '📊 امار ربات';
                                $key21          = '📨 پیام همگانی';
                                $key51          = '📨 فوروارد همگانی';
                                $key61          = '➕اضافه کردن سرویس';
                                $suppprt_result = '📮 پیام به کاربر';
                                $add_coin       = '➕ اضافه کردن موجودی';
                                $kasr_coin      = '➖کسر موجودی';
                                $add_time       = '🔁 تمدید سرویس';
                                $moton          = '📝 تنظیم متن ها';
                                $Settings       = '⚙️ تنظمیات';
                                $check_user     = '👤 پیگیری افراد';
                                $vaz            = '🔃 تغییر وضعیت حساب';
                        
                                $reply_keyboard_panel = [
                                                        [$key11] ,
                                                        [$key21 , $key51] ,
                                                        [$key61 , $suppprt_result] ,
                                                        [$add_coin , $kasr_coin , $add_time] ,
                                                        [$moton , $Settings , $check_user] ,
                                                        [$vaz] ,
                                
                                                      ];
                                 
                                    $reply_kb_options_panel = [
                                                            'keyboard'          => $reply_keyboard_panel ,
                                                            'resize_keyboard'   => true ,
                                                            'one_time_keyboard' => false ,
                                                        ];

                                                        $back = '◀️ بازگشت';

                                                            $reply_keyboard_back = [
                                                                                        [$back] ,
                                                                                        
                                                                                    ];
                                                                                         
$reply_kb_options_back = [
                                                                                            'keyboard'          => $reply_keyboard_back ,
                                                                                            'resize_keyboard'   => true ,
                                                                                            'one_time_keyboard' => false ,
                                                                                        ];

// if

$adminstep = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `step` FROM `users` WHERE `id`=$from_id LIMIT 1"));

if(isset($update->message->contact)){
    if($update->message->contact->user_id == $from_id){
        $phone =$update->message->contact->phone_number;
        if(strpos($phone,'98') === 0 || strpos($phone,'+98') === 0){
            $phone = '0'.strrev(substr(strrev($phone),0,10));
            mysqli_query($conn,"UPDATE users SET phone='$phone' WHERE id='$phoneid' LIMIT 1");
            bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ شماره تلفن شما با موفقیت ثبت و تایید شد.",
'reply_markup'=>json_encode($reply_kb_options),
]);

bot('sendmessage',[
'chat_id'=>$chanSef,
'text'=>"👤 ثبت نام جدید

☎️ : $phone
🆔 : $from_id",
]);
        }
        else{
            bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"کشور شما مجاز نیست فقط ایران مجاز است",
]);
exit;
        }
        
    }
}

if($data == "cart"){
    
    
            
$sqlnumber    = "SELECT phone FROM users WHERE id=$chat_id";
$resultnumber = mysqli_query($conn,$sqlnumber);

$resnumber = mysqli_fetch_assoc($resultnumber);
    if($resnumber['phone'] == 0){
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
📱 لطفا شماره موبایل خود را تایید نمایید.

👈جهت جلوگیری از خرید با کارت های دزدی نیاز است شماره خود را تایید نمائید و سپس اقدام به خرید کنید.

✔️شماره شما نزد ما محفوظ است و هیچ شخصی به آن دسترسی نخواهد داشت.
",
'reply_markup' => json_encode([ 
'resize_keyboard'=>true, 
'keyboard' => [ 
[['text'=>"⏳تایید شماره⏳",'request_contact'=>true]],
], 
]) 
]);

    }

            else{
            mysqli_query($conn,"UPDATE `users` SET `step`='pay_d' WHERE id='$chat_id' LIMIT 1");
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💳 مبلغی که میخواهید شارژ کنید را به تومان وارد کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_back),
        ]);
            }
}

if($adminstep['step'] == "pay_d" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    if(is_numeric($text)){
        
        bot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"💳 درگاه پرداخت ساخته شد

✅ بعد پرداخت موجودی خودکار واریز میشود",
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[['text'=>"💳 | پرداخت $text",'url'=>"$web/pay/index.php?amount=$text&id=$from_id"]],
              ]
              ])
	       ]);
	       
    }
    else{
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ | اطلاعات وارد شده شما اشتباه است",
        ]);
        
    }
}

if($adminstep['step'] == "support" and $text != $back){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ پیام با موفقیت ارسال شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options),
]);

bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"👨‍💻 سلام ادمین یک پیام برات امده 

📝 متن پیام : $text
👤 ارسال کننده : $chat_id",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "android"){
    
    $sql2    = "SELECT `android` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['android'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "windows"){
    
    $sql2    = "SELECT `windows` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['windows'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "ios"){
    
    $sql2    = "SELECT `ios` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['ios'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "mac"){
    
    $sql2    = "SELECT `mac` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['mac'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "linux"){
    
    $sql2    = "SELECT `linux` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['linux'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "back"){

        
        bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"📲 اندروید",'callback_data'=>"android"],
            ['text'=>"🖥 ویندوز",'callback_data'=>"windows"],
        ],
        [
            ['text'=>"📲 ios",'callback_data'=>"ios"],
            ['text'=>"💻 mac",'callback_data'=>"mac"],
            
        ],
        [
            ['text'=>"🖥 linux",'callback_data'=>"linux"],
            
        ],
        [
            ['text'=>"❌ بستن",'callback_data'=>"close"],
            
        ],
        ]
        ])
        ]);

}

if($data == "close"){

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"✅ بسته شد",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        ]);
}

if($adminstep['step'] == "key_hmgani" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
$sql    = "SELECT * FROM `users`";
$result = mysqli_query($conn,$sql);
 
 while($row = mysqli_fetch_assoc($result)){
        
    bot('sendMessage',[
'chat_id'=>$row['id'],
'text'=>"$text",
'parse_mode'=>"HTML",
]);
}
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
}


if($adminstep['step'] == "key_forvard" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$admin' LIMIT 1");
 
$sql    = "SELECT * FROM `users`";
$result = mysqli_query($conn,$sql);
 
 while($row = mysqli_fetch_assoc($result)){
        
    bot('ForwardMessage',[
'chat_id'=>$row['id'],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
    }
 
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
}

if($adminstep['step'] == "suppprt_result" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    $text_admin = explode(",",$text);
    $user_id = $text_admin['0'];
    $text_admin = $text_admin['1'];
    
    
    bot('sendmessage',[
'chat_id'=>$user_id,
'text'=>"👨‍💻 یک پیام از طرف مدیریت براتون امد 

📝 : $text_admin",
]);

bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
}


if($data == "bestgig"){
    
    bot('editmessagetext',[
        'chat_id'=>$chat_id,
'text'=>"🔑 جهت اضافه کردن کلید دستور العمل زیر را دنبال کنید

key,contry

key : کلید
contry : کشور

کشورهای مجاز 👇

france
germany
turkey
usa",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "bestgigBack" ] 
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='bestgig' WHERE id='$chat_id' LIMIT 1");
        exit();
}

if($data == "bestgigBack"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25 گیگ",'callback_data'=>"bestgig"],
            ['text'=>"40 گیگ",'callback_data'=>"chlgig"]
        ],
        [
            ['text'=>"60 گیگ",'callback_data'=>"shastgig"],
            ['text'=>"100 گیگ",'callback_data'=>"sadgog"]
        ],
        [
            ['text'=>"200 گیگ",'callback_data'=>"dvistgig"]
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "bestgig"){
    
$sql4    = "SELECT * FROM `vpn`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$ok = $res4 + 1;
    
    $text_admin = explode(",",$text);
    $kay = $text_admin['0'];
    $contry = $text_admin['1'];
    
    $sql2    = "INSERT INTO `vpn` (`id`, `code`, `hajm`, `contry`) VALUES ('$ok', '$kay', '25', '$contry')";
    $result2 = mysqli_query($conn,$sql2);
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"اانجامشد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "chlgig"){
    
    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"🔑 جهت اضافه کردن کلید دستور العمل زیر را دنبال کنید

key,contry

key : کلید
contry : کشور

کشورهای مجاز 👇

france
germany
turkey
 usa",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "chlgigback" ] 
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='chlgig' WHERE id='$chat_id' LIMIT 1");
        exit();
}

if($data == "chlgigback"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25 گیگ",'callback_data'=>"bestgig"],
            ['text'=>"40 گیگ",'callback_data'=>"chlgig"]
        ],
        [
            ['text'=>"60 گیگ",'callback_data'=>"shastgig"],
            ['text'=>"100 گیگ",'callback_data'=>"sadgog"]
        ],
        [
            ['text'=>"200 گیگ",'callback_data'=>"dvistgig"]
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
        
}

if($adminstep['step'] == "chlgig"){
    
$sql4    = "SELECT * FROM `vpn`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$ok = $res4 + 1;
    
    $text_admin = explode(",",$text);
    $kay = $text_admin['0'];
    $contry = $text_admin['1'];
    
    $sql2    = "INSERT INTO `vpn` (`id`, `code`, `hajm`, `contry`) VALUES ('$ok', '$kay', '45', '$contry')";
    $result2 = mysqli_query($conn,$sql2);
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انجام شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "shastgig"){
    
    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"🔑 جهت اضافه کردن کلید دستور العمل زیر را دنبال کنید

key,contry

key : کلید
contry : کشور

کشورهای مجاز 👇

france
germany
turkey
 usa",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "shastgigback" ] 
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='shastgig' WHERE id='$chat_id' LIMIT 1");
        exit();
}

if($data == "shastgigback"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25 گیگ",'callback_data'=>"bestgig"],
            ['text'=>"40 گیگ",'callback_data'=>"chlgig"]
        ],
        [
            ['text'=>"60 گیگ",'callback_data'=>"shastgig"],
            ['text'=>"100 گیگ",'callback_data'=>"sadgog"]
        ],
        [
            ['text'=>"200 گیگ",'callback_data'=>"dvistgig"]
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "shastgig"){
    
$sql4    = "SELECT * FROM `vpn`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$ok = $res4 + 1;
    
    $text_admin = explode(",",$text);
    $kay = $text_admin['0'];
    $contry = $text_admin['1'];
    
    $sql2    = "INSERT INTO `vpn` (`id`, `code`, `hajm`, `contry`) VALUES ('$ok', '$kay', '60', '$contry')";
    $result2 = mysqli_query($conn,$sql2);
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انجام شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "sadgog"){
    
    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"🔑 جهت اضافه کردن کلید دستور العمل زیر را دنبال کنید

key,contry

key : کلید
contry : کشور

کشورهای مجاز 👇

france
germany
turkey
 usa",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "sadgogback" ] 
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='sadgog' WHERE id='$chat_id' LIMIT 1");
        exit();
}

if($data == "sadgogback"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25 گیگ",'callback_data'=>"bestgig"],
            ['text'=>"40 گیگ",'callback_data'=>"chlgig"]
        ],
        [
            ['text'=>"60 گیگ",'callback_data'=>"shastgig"],
            ['text'=>"100 گیگ",'callback_data'=>"sadgog"]
        ],
        [
            ['text'=>"200 گیگ",'callback_data'=>"dvistgig"]
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "sadgog"){
    
$sql4    = "SELECT * FROM `vpn`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$ok = $res4 + 1;
    
    $text_admin = explode(",",$text);
    $kay = $text_admin['0'];
    $contry = $text_admin['1'];
    
    $sql2    = "INSERT INTO `vpn` (`id`, `code`, `hajm`, `contry`) VALUES ('$ok', '$kay', '100', '$contry')";
    $result2 = mysqli_query($conn,$sql2);
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انجام شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "dvistgig"){
    
    bot('editmessagetext',[
        'chat_id'=>$chat_id,
'text'=>"🔑 جهت اضافه کردن کلید دستور العمل زیر را دنبال کنید

key,contry

key : کلید
contry : کشور

کشورهای مجاز 👇

france
germany
turkey
 usa",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "dvistgigback" ] 
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='dvistgig' WHERE id='$chat_id' LIMIT 1");
        exit();
}

if($data == "dvistgigback"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25 گیگ",'callback_data'=>"bestgig"],
            ['text'=>"40 گیگ",'callback_data'=>"chlgig"]
        ],
        [
            ['text'=>"60 گیگ",'callback_data'=>"shastgig"],
            ['text'=>"100 گیگ",'callback_data'=>"sadgog"]
        ],
        [
            ['text'=>"200 گیگ",'callback_data'=>"dvistgig"]
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "dvistgig"){
    
$sql4    = "SELECT * FROM `vpn`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$ok = $res4 + 1;
    
    $text_admin = explode(",",$text);
    $kay = $text_admin['0'];
    $contry = $text_admin['1'];
    
    $sql2    = "INSERT INTO `vpn` (`id`, `code`, `hajm`, `contry`) VALUES ('$ok', '$kay', '200', '$contry')";
    $result2 = mysqli_query($conn,$sql2);
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انجام شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "add_coin" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    $text_admin = explode(",",$text);
    $user_id = $text_admin['0'];
    $coin = $text_admin['1'];
    
    $sql2    = "SELECT `coin` FROM `users` WHERE `id`=$user_id";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['coin'];
    
    $coin_new = $trsrul2 + $coin;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_new' WHERE id='$user_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

bot('sendMessage',[
'chat_id'=>$user_id,
'text'=>"👤 کاربر عزیز مقدار $coin به حساب شما از طرف مدیریت اضافه شد",
'parse_mode'=>"HTML",
]);
    
    

}

if($adminstep['step'] == "kasr_coin" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    $text_admin = explode(",",$text);
    $user_id = $text_admin['0'];
    $coin = $text_admin['1'];
    
    $sql2    = "SELECT `coin` FROM `users` WHERE `id`=$user_id";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['coin'];
    
    $coin_new = $trsrul2 - $coin;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_new' WHERE id='$user_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

bot('sendMessage',[
'chat_id'=>$user_id,
'text'=>"👤 کاربر عزیز مقدار $coin از حساب شما از طرف مدیریت کسر شد",
'parse_mode'=>"HTML",
]);
    
    

}

if($data == "tron"){
    
    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"👤 سلام عزیز به بخش واریز ترون خوش امدید برای اضافه کردن موجودی مبلغی که میخواهید شارژ کنید را به حساب زیر واریز کنید بعد عکس رسید را ارسال فرمایید

❌ تا ارسال نکردن عکس از این قسمت خارج نشید اگه قصد لغو داشتید از دکمه بازگشت استفاده کنید

💳 : $tronW",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "tronback" ] 
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='tron' WHERE id='$chat_id' LIMIT 1");
}
if($data == "tronback"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"لغو شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "tron"){
    
    bot('ForwardMessage',[
'chat_id'=>$admin,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);

bot('sendMessage',[
        'chat_id'=>$admin,
        'text'=>"🔑 #Pay

واریزی جدید انجام شده عکس ارسالی کاربر پست بالا 👆

👤 : $chat_id",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "pay"){
    
    pay();
}

if($data == "france"){
    
$sql4    = "SELECT * FROM `vpn` WHERE contry='france' LIMIT 1";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

if($res4 == 0){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
}
else{
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25G",'callback_data'=>"bestPangGig25"],
            ['text'=>"45G",'callback_data'=>"ChlPangGig45"],
        ],
        [
            ['text'=>"60G",'callback_data'=>"ShastGig60"],
            ['text'=>"100",'callback_data'=>"sadGig100"],
            
        ],
        [
            ['text'=>"150G",'callback_data'=>"SadPanjah150"],
            
        ],
        [
            ['text'=>"200G",'callback_data'=>"dvistGig200"],
            
        ],
        ]
        ])
        ]);
}
}

if($data == "bestPangGig25"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='25'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig25){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 25 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig25;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
        
    }
       else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
        
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ChlPangGig45"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='45'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig45){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '45' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 45 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig45;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"تخم سگ موجودی نداری",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ShastGig60"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='60'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig60){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 60 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig60;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "sadGig100"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='100'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig100){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '100' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 100 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig100;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "SadPanjah150"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='150'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig150){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '150' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig150;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "dvistGig200"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='200'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig200){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '200' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig200;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "turkey"){
    
$sql4    = "SELECT * FROM `vpn` WHERE contry='turkey' LIMIT 1";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

if($res4 == 0){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
}
else{
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25G",'callback_data'=>"bestPangGig25t"],
            ['text'=>"45G",'callback_data'=>"ChlPangGig45G"],
        ],
        [
            ['text'=>"60G",'callback_data'=>"ShastGig60Gt"],
            ['text'=>"100",'callback_data'=>"sadGig100Gt"],
            
        ],
        [
            ['text'=>"150G",'callback_data'=>"SadPanjah150Gt"],
            
        ],
        [
            ['text'=>"200G",'callback_data'=>"dvistGig200Gt"],
            
        ],
        ]
        ])
        ]);
}
}

if($data == "bestPangGig25Gt"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='25'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig25){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 25 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig25;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
        
    }
       else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
        
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ChlPangGig45Gt"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='45'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig45){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '45' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 45 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig45;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ShastGig60G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='60'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig60){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '60' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 60 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig60;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "sadGig100Gt"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='100'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig100){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '100' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 100 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig100;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "SadPanjah150Gt"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='150'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig150){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '150' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig150;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "dvistGig200t"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='200'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig200){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '200' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig200;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "germany"){
    
$sql4    = "SELECT * FROM `vpn` WHERE contry='germany' LIMIT 1";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

if($res4 == 0){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
}
else{
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کن کسکش",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25G",'callback_data'=>"bestPangGig25G"],
            ['text'=>"45G",'callback_data'=>"ChlPangGig45G"],
        ],
        [
            ['text'=>"60G",'callback_data'=>"ShastGig60G"],
            ['text'=>"100",'callback_data'=>"sadGig100G"],
            
        ],
        [
            ['text'=>"150G",'callback_data'=>"SadPanjah150G"],
            
        ],
        [
            ['text'=>"200G",'callback_data'=>"dvistGig200G"],
            
        ],
        ]
        ])
        ]);
}
}

if($data == "bestPangGig25G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='25'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig25){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 25 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig25;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
        
    }
       else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
        
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ChlPangGig45G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='45'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig45){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '45' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 45 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig45;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ShastGig60G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='60'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig60){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '60' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 60 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig60;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "sadGig100G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='100'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig100){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '100' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 100 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig100;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "SadPanjah150G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='150'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig150){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '150' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig150;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "dvistGig200"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='200'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig200){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '200' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig200;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "usa"){
    
$sql4    = "SELECT * FROM `vpn` WHERE contry='usa' LIMIT 1";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

if($res4 == 0){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
}
else{
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25G",'callback_data'=>"bestPangGig25Gu"],
            ['text'=>"45G",'callback_data'=>"ChlPangGig45Gu"],
        ],
        [
            ['text'=>"60G",'callback_data'=>"ShastGig60Gu"],
            ['text'=>"100",'callback_data'=>"sadGig100Gu"],
            
        ],
        [
            ['text'=>"150G",'callback_data'=>"SadPanjah150Gu"],
            
        ],
        [
            ['text'=>"200G",'callback_data'=>"dvistGig200G"],
            
        ],
        ]
        ])
        ]);
}
}

if($data == "bestPangGig25Gu"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='25'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig25){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 25 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig25;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
        
    }
       else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
        
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ChlPangGig45Gu"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='45'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig45){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '45' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 45 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig45;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ShastGig60G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='60'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig60){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '60' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 60 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig60;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "sadGig100Gu"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='100'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig100){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '100' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 100 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig100;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "SadPanjah150Gu"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='150'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig150){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '150' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig150;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "dvistGig200"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='200'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig200){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '200' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig200;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($adminstep['step'] == "add_time" and $text != $back){
    
    $text_admin = explode(",",$text);
    $kay = $text_admin['0'];
    $time = $text_admin['1'];
    
    mysqli_query($conn,"UPDATE `Bought` SET `date`='$time' WHERE code='$kay' LIMIT 1");
    
$sql223    = "SELECT `Owner` FROM `Bought` WHERE `code`=$kay";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['Owner'];

bot('sendMessage',[
        'chat_id'=>$trsrul223,
        'text'=>"✅ سرویس تمدید شد با کلید $key با زمان $time انجام شد",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "tarefe"){
    
     bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='tarefe' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "tarefe" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `tarfe`='$text'");
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "soyalat"){
    
     bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='soyalat' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "soyalat" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `help`='$text'");
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "androidHelp"){
    
     bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='androidHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "androidHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `android`='$text'");
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "windowsHelp"){
    
     bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='windowsHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "windowsHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `windows`='$text'");
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "macHelp"){
    
     bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='macHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "macHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `mac`='$text'");
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "iosHelp"){
    
     bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='iosHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "iosHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `ios`='$text'");
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "linuxHelp"){
    
     bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='linuxHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "linuxHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `linux`='$text'");
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "offBot"){
    
    $sql2    = "SELECT `bot` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['bot'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `bot`='off'");
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ ربات از قبل خاموش میباشد",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "onBot"){
    
    $sql2    = "SELECT `bot` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['bot'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `bot`='on'");
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ ربات ازقبل روشن میباشد",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "payoff"){
    
    $sql2    = "SELECT `pay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['pay'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `pay`='off'");
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ خرید از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "payon"){
    
    $sql2    = "SELECT `pay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['pay'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `pay`='on'");
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ خرید از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "sharjOff"){
    
    $sql2    = "SELECT `sharj` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['sharj'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `sharj`='off'");
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ شارژ حساب از قبل خاموس بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "sharjon"){
    
    $sql2    = "SELECT `sharj` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['sharj'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `sharj`='on'");
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ شارژ حساب از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "supportoff"){
    
    $sql2    = "SELECT `support` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['support'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `support`='off'");
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ پشتیبانی از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "supporton"){
    
    $sql2    = "SELECT `support` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['support'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `support`='on'");
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ پشتیبانی از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "chanelJ"){
    
    $sql2    = "SELECT `chanel` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['chanel'];
    
    mysqli_query($conn,"UPDATE `users` SET `step`='chanelJ' WHERE id='$chat_id' LIMIT 1");
    
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"👤 ادمین گرامی جهت تنظیم کانال جوین اجباری ایدی کانال را بدون @ ارسال فرمایید در صورتی که میخواهید جوین اجباری را بردارید کلمه on را ارسال فرمایید

👈 کانال فعلی : $trsrul2",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
    
}

if($adminstep['step'] == "chanelJ" and $text != $back){
    
    mysqli_query($conn,"UPDATE `Settings` SET `chanel`='$text'");
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}


if($adminstep['step'] == "check_user" and $text != $back){
    
    $sql2    = "SELECT `id` FROM `users` WHERE `id`=$text";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['id'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`=$text";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    $sql23    = "SELECT `phone` FROM `users` WHERE `id`=$text";
    $result23 = mysqli_query($conn,$sql23);
    $res23 = mysqli_fetch_assoc($result23);
    $trsrul23  = $res23['phone'];
    
    $sql24    = "SELECT `account` FROM `users` WHERE `id`=$text";
    $result24 = mysqli_query($conn,$sql24);
    $res24 = mysqli_fetch_assoc($result24);
    $trsrul24  = $res24['account'];
    
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 اطلاعات کاربر مورد نظر شما :",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"🆔",'callback_data'=>"ddddddd"],
            ['text'=>"$text",'callback_data'=>"ddddddd"]
            
        ],
        [
            ['text'=>"💰 موجودی",'callback_data'=>"ddddddd"],
            ['text'=>"$trsrul22",'callback_data'=>"ddddddd"],
            
        ],
        [
            ['text'=>"☎️ شماره تماس",'callback_data'=>"ddddddd"],
            ['text'=>"$trsrul23",'callback_data'=>"ddddddd"],
            
        ],
        [
            ['text'=>"👤 وضعیت حساب",'callback_data'=>"ddddddd"],
            ['text'=>"$trsrul24",'callback_data'=>"ddddddd"],
            
        ],
        ]
        ])
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ جستجو انجام شد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
    else{
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ همچین کاربری وجود ندارد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "banUser"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 ایدی عددی کاربر را وارد کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_back),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='banUser' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "banUser" and $text != $back){
    
    $sql2    = "SELECT `id` FROM `users` WHERE `id`=$text";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['id'];
    
    if(isset($trsrul2)){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ انجام شد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `account`='ban' WHERE id='$text' LIMIT 1");
        
        bot('sendMessage',[
        'chat_id'=>$text,
        'text'=>"👤 کاربر گرامی حساب شما از طرف مدیریت مسدود شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ همچین کاربری وجود ندارد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "onUser"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 ایدی عددی کاربر را وارد کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_back),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='onUser' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "onUser" and $text != $back){
    
    $sql2    = "SELECT `id` FROM `users` WHERE `id`=$text";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['id'];
    
    if(isset($trsrul2)){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ انجام شد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `account`='ok' WHERE id='$text' LIMIT 1");
        
        bot('sendMessage',[
        'chat_id'=>$text,
        'text'=>"👤 کاربر گرامی حساب شما از طرف مدیریت ازاد شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ همچین کاربری وجود ندارد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
}

switch($text) {
 
                                                            case "/start"              : show_menu();       break;
                                                            case $key1                 : profile();         break;
                                                            case $key2                 : pay_server();      break;
                                                            case $key5                 : serves();          break;
                                                            case $key6                 : tarfe();           break;                                                                                          
                                                            case $key7                 : support();         break;
                                                            case $key8                 : help();            break;
                                                            case $key9                 : qussh();           break;
                                                            case $pay                  : pay();              break;
                                                            case $back                 : back();            break;
}
                                                        
if($from_id == $admin){
                                                        
                                                        switch($text) {
                                                     
                                                            case $key11 : statistics();                break;
                                                            case "/admin" : panel();                   break;
                                                            case $key21 : key_hmgani();                break;
                                                            case $key51 : key_forvard();               break;
                                                            case $key61 : addserves();                 break;
                                                            case $suppprt_result : suppprt_result();   break;
                                                            case $add_coin : add_coin();               break;
                                                            case $kasr_coin : kasr_coin();             break;
                                                            case $add_time  : add_time();              break;
                                                            case $moton : moton();                     break;
                                                            case $Settings : Settings();               break;
                                                            case $check_user : check_user();           break;
                                                            case $vaz : vaz();                         break;
                                                            
                                                        }
}

                                                        // function

function show_menu(){
                                                            global $reply_kb_options;
                                                            global $chat_id;
                                                            global $vpnname;
                                                        
                                                        bot('sendMessage',[
                                                        'chat_id'=>$chat_id,
                                                        'text'=>"🥷 سلام به ربات $vpnname خوش امدی",
                                                        'parse_mode'=>"HTML",
                                                        'reply_markup'=>json_encode($reply_kb_options),
                                                        ]);
}

function support(){

    global $chat_id;
    global $reply_kb_options_back;
    global $conn;
    
    $sql2    = "SELECT `support` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['support'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش از طرف مدیریت خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
    
    mysqli_query($conn,"UPDATE `users` SET `step`='support' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬 پیام خود را ارسال کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

}

function qussh(){

    global $chat_id;
    global $conn;
    
    $sql22    = "SELECT `help` FROM `moton`";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22 = $res22['help'];

    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul22",
        'parse_mode'=>"HTML",
        ]);
}

function help(){

    global $chat_id;

    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"راهنمای اتصال سرویس ها",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"📲 اندروید",'callback_data'=>"android"],
            ['text'=>"🖥 ویندوز",'callback_data'=>"windows"],
        ],
        [
            ['text'=>"📲 ios",'callback_data'=>"ios"],
            ['text'=>"💻 mac",'callback_data'=>"mac"],
            
        ],
        [
            ['text'=>"🖥 linux",'callback_data'=>"linux"],
            
        ],
        [
            ['text'=>"❌ بستن",'callback_data'=>"close"],
            
        ],
        ]
        ])
        ]);
}

function profile(){

    global $chat_id;
    global $conn;
    global $bot_id;

    $sql    = "SELECT `Owner` FROM `Bought` WHERE `Owner`=$chat_id";
    $result = mysqli_query($conn,$sql);
    $res    = mysqli_num_rows($result);

    $sql2    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2 = $res2['coin'];
    
    $sql22    = "SELECT `phone` FROM `users` WHERE `id`=$chat_id";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22 = $res22['phone'];

    bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"👤 اطلاعات حساب

👤 شناسه : $chat_id
💳 موجودی : $trsrul2
🖥 تعداد سرویس ها : $res
☎️ شماره تلفن : $trsrul22

🤖 @$bot_id",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"شارژ حساب",'callback_data'=>"pay"]
        ],
        ]
        ])
        ]);

}

function pay(){
    
    global $chat_id;
    global $conn;
    
    $sql2    = "SELECT `sharj` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['sharj'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش از طرف مدیریت خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 کاربر عزیز نوع واریزی خود را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"پرداخت با کارت",'callback_data'=>"cart"],
            
        ],
        [
            ['text'=>"پرداخت با ترون",'callback_data'=>"tron"],
            
        ],
        ]
        ])
        ]);
    
    
}
function serves(){
    
    global $chat_id;
    global $conn;
    
$sql    = "SELECT * FROM `vpn` WHERE `contry`='france'";
$result = mysqli_query($conn,$sql);
$res    = mysqli_num_rows($result);

$sql2    = "SELECT * FROM `vpn` WHERE contry='germany'";
$result2 = mysqli_query($conn,$sql2);
$res2    = mysqli_num_rows($result2);

$sql3    = "SELECT * FROM `vpn` WHERE contry='turkey'";
$result3 = mysqli_query($conn,$sql3);
$res3    = mysqli_num_rows($result3);

$sql4    = "SELECT * FROM `vpn` WHERE contry='usa'";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"📊 تعداد سرویس های موجود",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"🇫🇷 فرانسه",'callback_data'=>"ddddddd"],
            ['text'=>"$res",'callback_data'=>"ddddddd"]
            
        ],
        [
            ['text'=>"🇩🇪 المان",'callback_data'=>"ddddddd"],
            ['text'=>"$res2",'callback_data'=>"ddddddd"],
            
        ],
        [
            ['text'=>"🇹🇷 ترکیه",'callback_data'=>"ddddddd"],
            ['text'=>"$res3",'callback_data'=>"ddddddd"],
            
        ],
        [
            ['text'=>"🇺🇸 امریکا",'callback_data'=>"ddddddd"],
            ['text'=>"$res4",'callback_data'=>"ddddddd"],
            
        ],
        ]
        ])
        ]);
}
function tarfe(){
    
    global $chat_id;
    global $conn;
    
    $sql22    = "SELECT `tarfe` FROM `moton`";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22 = $res22['tarfe'];
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul22",
        'parse_mode'=>"HTML",
        ]);
}

function panel(){
    
    
    
    global $chat_id;
    global $admin;
    global $reply_kb_options_panel;
    if($chat_id == $admin){
    
    bot('sendMessage',[
                                                        'chat_id'=>$chat_id,
                                                        'text'=>"به پنل مدیریت خوش امدید",
                                                        'parse_mode'=>"HTML",
                                                        'reply_markup'=>json_encode($reply_kb_options_panel),
                                                        ]);
}}

function key_hmgani(){
    
    global $admin;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 پیام خود را بنویسید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='key_hmgani' WHERE id='$admin' LIMIT 1");
}

function key_forvard(){
    
    global $admin;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"📝 پیام خود را فوروارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='key_forvard' WHERE id='$admin' LIMIT 1");
}

function statistics(){
    
    global $conn;
    global $chat_id;
    
$sql    = "SELECT * FROM `users`";
$result = mysqli_query($conn,$sql);
$res    = mysqli_num_rows($result);

$sql2    = "SELECT * FROM `vpn`";
$result2 = mysqli_query($conn,$sql2);
$res2    = mysqli_num_rows($result2);


$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"امار شما : ",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"امار کاربران",'callback_data'=>"gggggg"],
            ['text'=>"$res",'callback_data'=>"gggggg"],
        ],
        [
            ['text'=>"امار سرویس های موجود",'callback_data'=>"gggggg"],
            ['text'=>"$res2",'callback_data'=>"gggggg"],
        ],
        [
            ['text'=>"فروخته شده",'callback_data'=>"gggggg"],
            ['text'=>"$res4",'callback_data'=>"gggggg"],
        ],
        ]
        ])
        ]);
    
}

function suppprt_result(){
    
    global $chat_id;
    global $reply_kb_options_back;
    global $conn;
    
    mysqli_query($conn,"UPDATE `users` SET `step`='suppprt_result' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 کاربری که میخای براش پیام بفرستی پیام را به صورت زیر بنویس
id,message",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
}
function addserves(){
    
    global $chat_id;
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25 گیگ",'callback_data'=>"bestgig"],
            ['text'=>"40 گیگ",'callback_data'=>"chlgig"]
        ],
        [
            ['text'=>"60 گیگ",'callback_data'=>"shastgig"],
            ['text'=>"100 گیگ",'callback_data'=>"sadgog"]
        ],
        [
            ['text'=>"200 گیگ",'callback_data'=>"dvistgig"]
        ],
        ]
        ])
        ]);
}
function back(){
    
    global $reply_kb_options;
    global $chat_id;

bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"↩️ به منو اصلی برگشتیم",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options),
]);
}
function pay_server(){
    
    global $chat_id;
    global $conn;
    
    $sql2    = "SELECT `pay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['pay'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش از طرف مدیریت خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"فرانسه",'callback_data'=>"france"],
            ['text'=>"المان",'callback_data'=>"germany"]
        ],
        [
            ['text'=>"ترکیه",'callback_data'=>"turkey"],
            ['text'=>"امریکا",'callback_data'=>"usa"]
        ],
        ]
        ])
        ]);
}
function add_coin(){
    
    global $chat_id;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 کاربری که میخاید به موجودی حسابش اضافه کنید ایدی عددی و موجودی را به صورت زیر بفرستید
id,coin",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='add_coin' WHERE id='$chat_id' LIMIT 1");
}
function kasr_coin(){
    
    global $chat_id;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 کاربری که میخاید از حسابش سکه کسر کنید اول ایدی عددی دوم تعداد سکه را به صورت زیر بنویسید
id,coin",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='kasr_coin' WHERE id='$chat_id' LIMIT 1");
}

function add_time(){
    
    global $chat_id;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 ادمینعزیز پیام رابهصورتزیر بنویسید کلید و تاریخبه میلادی
code,time",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='add_time' WHERE id='$chat_id' LIMIT 1");
    
    
}


function moton(){
    
    global $chat_id;
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👈 لطفا بخش مورد نظر خود را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"📝 متن تعرفه ها",'callback_data'=>"tarefe"],
        ],
        [
            ['text'=>"📝 متن سوالات",'callback_data'=>"soyalat"],
        ],
        [
            ['text'=>"📝 متن راهنما اندروید",'callback_data'=>"androidHelp"],
        ],
        [
            ['text'=>"📝 متن راهنما ویندوز",'callback_data'=>"windowsHelp"],
        ],
        [
            ['text'=>"📝 متن راهنما mac",'callback_data'=>"macHelp"],
        ],
        [
            ['text'=>"📝 متن راهنما ios",'callback_data'=>"iosHelp"],
        ],
        [
            ['text'=>"📝 متن راهنما linux",'callback_data'=>"linuxHelp"],
        ],
        ]
        ])
        ]);
}

function Settings(){
    
    global $chat_id;
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👈 لطفا بخشی که میخواهید تنظیم کنید را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"❌ خاموش کردن ربات",'callback_data'=>"offBot"],
        ],
        [
            ['text'=>"✅ روشن کردن ربات",'callback_data'=>"onBot"],
        ],
        [
            ['text'=>"❌ خاموش کردن خرید",'callback_data'=>"payoff"],
        ],
        [
            ['text'=>"✅ روشن کردن خرید",'callback_data'=>"payon"],
        ],
        [
            ['text'=>"❌ خاموش کردن شارژ حساب",'callback_data'=>"sharjOff"],
        ],
        [
            ['text'=>"✅ روشن کردن شارژ حساب",'callback_data'=>"sharjon"],
        ],
        [
            ['text'=>"❌ خاموش کردن پشتیبانی",'callback_data'=>"supportoff"],
        ],
        [
            ['text'=>"✅ روشن کردن پشتیبانی",'callback_data'=>"supporton"],
        ],
        [
            ['text'=>"⚙️ چنل جوین اجباری",'callback_data'=>"chanelJ"],
        ],
        ]
        ])
        ]);
}

function check_user(){
    
    global $conn;
    global $chat_id;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 ایدی عددی کاربر را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='check_user' WHERE id='$chat_id' LIMIT 1");
    
    
}

function vaz(){
    
    global $chat_id;
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👈 لطفا بخشی که میخواهید تنظیم کنید را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"❌ بن کاربر",'callback_data'=>"banUser"],
        ],
        [
            ['text'=>"✅ ازاد کردن کاربر",'callback_data'=>"onUser"],
        ],
        ]
        ])
        ]);
}




?>