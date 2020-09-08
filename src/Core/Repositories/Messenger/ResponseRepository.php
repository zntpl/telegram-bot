<?php


namespace App\Core\Repositories\Messenger;

use App\Core\Entities\BotEntity;
use App\Core\Entities\ResponseEntity;
use App\Core\Helpers\HttpHelper;
use App\Core\Interfaces\Repositories\ResponseRepositoryInterface;
use danog\MadelineProto\Exception;
use ZnCore\Base\Domain\Helpers\EntityHelper;

class ResponseRepository implements ResponseRepositoryInterface
{

    const URL = 'http://symfony.tpl/api/v1';

    public function send(ResponseEntity $responseEntity, BotEntity $botEntity)
    {
        $data = EntityHelper::toArrayForTablize($responseEntity);
        $query = http_build_query($data);
        $token = $botEntity->getToken();
        $uri = "bot/$token/send-message";
        $url = self::URL . "/$uri?$query";
        $json = HttpHelper::getHtml($url);
        $data = json_decode($json);
        if (empty($data->ok)) {
            //dd($data);
            throw new Exception('Driver error! ' . $json);
        }
    }

}