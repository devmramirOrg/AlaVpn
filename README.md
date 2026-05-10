# 🤖 AlaVpn - Telegram Vpn Bot

## ✨ Features

- ⭐ **Selling v2ray configuration
- 👑 **Powerful admin panel
- 📱 **Connected to the Zarinpal payment gateway

## 🛠️ Technologies

- **PHP 7.4+** - Backend logic
- **MySQL** - Database management
- **Telegram Bot API** - Bot functionality
- **mysqli_connect** - Secure database connections

## 📋 Requirements

- PHP 7.4
- MySQL
- Web server (Apache)
- SSL certificate (for webhook)
- Telegram Bot Token (from [@BotFather](https://t.me/BotFather))

## 🚀 Installation

### 1. Clone the repository
```bash
git clone https://github.com/devmramirOrg/AlaVpn.git
cd AlaVpn
```

### 2. Configure `config.php`

Edit the `config.php` file and fill in your details:

```php
<?php
//------- Data -------
$token        = "token"; // Telegram Bot Token
$admin        = "544316811"; //  Admin Id
$vpnname      = ""; // Vpn Name
$bot_id       = "AlaVpnBot"; //Bot Id
$tronW        = ""; // Tron Walet
$cart         = "تست"; // Bank Cart Number
$gig25        = 1; // قیمت سرور 25 گیگ
$gig40        = 1; // قیمت سرور 40 گیگ
$gig60        = 1; // قیمت سرور 60 گیگ
$gig100       = 1; // قیمت سرور 100 گیگ
$gig150       = 1; // قیمت سرور 150 گیگ
$gig200       = 1; // قیمت سرور 200 گیگ
$chanSef      = "-1001583024952"; // ایدی عددی چنل سفارشات
$MerchantID   = ""; // مرچند درگاه زرین پال
$web          = "https://amirhosin.gigapanel.xyz/vpnPro"; // ادرس دامنه سورس با پوشه

// Database Configuration
$serverName   = "localhost";
$db_name      = "name";
$db_user      = "user";
$db_pass      = 'passwird';
?>
```
### 3. Open `table.php` on Browser
```text
https://YourDomain.com/YourFileName/table.php
```
### 4. PhpMyAdmin
```
INSERT INTO Settings (bot, pay, sharj, support, chanel) VALUES ('on', 'on', 'on', 'on', 'on')

INSERT INTO moton (android, windows, tarfe, ios, mac, linux, help) VALUES ('on', 'on', 'on', 'on', 'on', 'on', 'on')
```

### 5. SetWebhook on `index.php`
```text
https://api.telegram.org/botYOURTOKEN/setwebhook?url=https://yourdomain.com/yourfilename/index.php
```
- YOURTOKEN : Your Telegram ‌Bot Token

## 🌐 Connect with Us

<div align="center">

| | |
|:---:|:---:|
| 📢 **Official Channel** | 👨‍💻 **Developer** |
| [**@alacode**](https://t.me/alacode) | [**@devmramir**](https://t.me/devmramir) |

---


[![Join Telegram Channel](https://img.shields.io/badge/Join_Our_Channel-@alacode-26A5E4?style=for-the-badge&logo=telegram&logoColor=white)](https://t.me/alacode)

[![Contact Developer](https://img.shields.io/badge/Contact_Developer-@devmramir-26A5E4?style=for-the-badge&logo=telegram&logoColor=white)](https://t.me/devmramir)

> 💬 **For support, updates, and more bots, join our Telegram channel!**

</div>
