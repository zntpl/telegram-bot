<?php


namespace App\Client\Controllers;


class IndexController
{

    public function form()
    {
        $messageId = 3739;
        $updateId = 692451587;
        $userId = $_GET['user_id'] ?? null;
        $botId = $_GET['bot_id'] ?? null;
        $userName = 'user' . $userId;
        $chatId = $userId;
        $chatName = $userName;
        $chatType = 'private';
        $date = time();
        //$languageCode = 'ru';

        $botConfig = include __DIR__ . '/../../../config/bot.php';
        $render = __DIR__ . '/../Views/form.php';
        include __DIR__ . '/../../Web/Views/layout.php';
    }

}
