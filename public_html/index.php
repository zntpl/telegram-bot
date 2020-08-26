<?php

$devUrl = 'http://test.bot/bot.php?token=773713470:AAHTBIYMDvcreuZBxKpvAQWVLOQOG24F-mE&update_id=592564491&message[message_id]=3915&message[from][id]=377819118&message[from][is_bot]=0&message[from][first_name]=phpGuru&message[from][username]=phpGuru&message[from][language_code]=ru&message[chat][id]=377819118&message[chat][first_name]=phpGuru&message[chat][username]=phpGuru&message[chat][type]=private&message[date]=1597585904';
$prodUrl = 'https://tlgbot12.000webhostapp.com?token=773713470:AAHTBIYMDvcreuZBxKpvAQWVLOQOG24F-mE&update_id=592564491&message[message_id]=3915&message[from][id]=377819118&message[from][is_bot]=0&message[from][first_name]=phpGuru&message[from][username]=phpGuru&message[from][language_code]=ru&message[chat][id]=377819118&message[chat][first_name]=phpGuru&message[chat][username]=phpGuru&message[chat][type]=private&message[date]=1597585904';

?>

<ul>
    <li>
        <a href="<?= $devUrl ?>&message[text]=help">
            dev help
        </a>
    </li>
    <li>
        <a href="<?= $devUrl ?>&message[text]=inline_keyboard">
            dev inline_keyboard
        </a>
    </li>
    <li>
        <a href="<?= $prodUrl ?>&message[text]=help">
            prod help
        </a>
    </li>
    <li>
        <a href="https://tlgbot12.000webhostapp.com/var/out.txt">
            prod out.txt
        </a>
    </li>
</ul>

<?php

exit;

$rootDir = realpath(__DIR__ . '/..');
$vendorDir = $rootDir . '/vendor';
$pharPath = 'phar://' . $vendorDir;
//exit($pharPath . '/vendor.phar/autoload.php');
require_once $pharPath . '/vendor.phar/autoload.php';

/*use PhpLab\Core\Legacy\Yii\Helpers\FileHelper;
exit(FileHelper::path('jhgfd'));*/

$Telegram_botkey= '773713470:AAHTBIYMDvcreuZBxKpvAQWVLOQOG24F-mE';
$json = file_get_contents('php://input');
$request = json_decode($json, TRUE);
file_put_contents(__DIR__ . '/out.txt', $json);
if (isset($request['message']))
{
    $first_name=",n,mn";
    $last_name=",mn,mn";
    $username=",mn,mn";
    $text=",mn,n";

    $chat_id=$request['message']['chat']['id'];
    if ($request['message']['chat']['type']=="private")
    {
        if (isset($request['message']['chat']['first_name'])) $first_name=$request['message']['chat']['first_name'];
        if (isset($request['message']['chat']['last_name'])) $last_name=$request['message']['chat']['last_name'];
        if (isset($request['message']['chat']['username'])) $username=$request['message']['chat']['username'];

        if ($first_name!="" AND $last_name!="") $text="Здравствуйте, ".$first_name." ".$last_name."!";

        if ($text!="")
        {
            $text=urlencode ($text);
            $url = "https://api.telegram.org/bot".$Telegram_botkey."/sendMessage?chat_id=".$chat_id."&text=".$text."&parse_mode=HTML&disable_web_page_preview=false&disable_notification=false";
            $json=file_get_contents($url);
        }
    } //private chat
} //message


