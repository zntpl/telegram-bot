<?php


namespace App\Core\Repositories\Test;

use App\Core\Entities\BotEntity;
use App\Core\Entities\ResponseEntity;
use App\Core\Interfaces\Repositories\ResponseRepositoryInterface;
use App\Core\Services\RequestService;
use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Core\Libs\Store\StoreFile;

class ResponseRepository implements ResponseRepositoryInterface
{

    private $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function send(ResponseEntity $responseEntity, BotEntity $botEntity)
    {
        $data = EntityHelper::toArrayForTablize($responseEntity);
        $file = $this->fileName($botEntity->getId(), $responseEntity->getChatId());
        $store = new StoreFile($file);
        $collection = $store->load();

        $requestData = [
            "chat_id" => $botEntity->getId(),
            "text" => $this->requestService->getRequest()->getMessage()->getText(),
            /*"parse_mode" => "HTML",
            "disable_web_page_preview" => "false",
            "disable_notification" => "false"*/
        ];

        $collection[] = $requestData;
        $collection[] = $data;
        $store->save($collection);
    }

    public function all(int $botId, int $chatId)
    {
        $file = $this->fileName($botId, $chatId);
        $store = new StoreFile($file);
        return $store->load();
    }

    private function fileName(int $botId, int $chatId)
    {
        return __DIR__ . '/../../../../var/dev/chat/' . $chatId . '/' . $botId . '.json';
    }
}