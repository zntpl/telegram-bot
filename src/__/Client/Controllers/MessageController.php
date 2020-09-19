<?php


namespace App\Client\Controllers;


use ZnLib\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;

class MessageController
{

    private $responseRepository;

    public function __construct(ResponseRepositoryInterface $responseRepository)
    {
        $this->responseRepository = $responseRepository;
    }

    public function all()
    {
        $userId = $_GET['user_id'] ?? null;
        $botId = $_GET['bot_id'] ?? null;
        $userName = 'user' . $userId;
        $chatId = $userId;
        $chatName = $userName;
        $chatType = 'private';

        if(method_exists($this->responseRepository, 'all')) {
            $all = $this->responseRepository->all($botId, $userId);
        } else {
            $all = [];
        }

        $botConfig = include __DIR__ . '/../../../config/bot.php';
        $render = __DIR__ . '/../Views/all.php';
        include __DIR__ . '/../../Web/Views/layout.php';
    }

}
