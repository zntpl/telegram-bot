<?php


namespace App\Core\Repositories\Telegram;

use App\Core\Entities\BotEntity;
use App\Core\Entities\ResponseEntity;
use App\Core\Helpers\HttpHelper;
use App\Core\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnCore\Base\Domain\Helpers\EntityHelper;

class ResponseRepository implements ResponseRepositoryInterface
{

    const URL = 'https://api.telegram.org';

    public function send(ResponseEntity $responseEntity, BotEntity $botEntity)
    {
        $data = EntityHelper::toArrayForTablize($responseEntity);
        foreach ($data as $key => $value) {
            if(empty($value)) {
                unset($data[$key]);
            }
        }
//        dd($data);
        $query = http_build_query($data);
        $token = $botEntity->getToken();
        $uri = "bot$token/sendMessage";
        $url = self::URL . "/$uri?$query";
        $json = HttpHelper::getHtml($url);
        $data = json_decode($json);
        if (empty($data->ok)) {
            $description = $data->description ? $data->description : 'Driver error!';
            throw new \Exception($description);
        }
    }
}