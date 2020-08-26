<?php


namespace App\Core\Interfaces\Repositories;

use App\Core\Entities\BotEntity;
use App\Core\Entities\ResponseEntity;

interface ResponseRepositoryInterface
{

    public function send(ResponseEntity $responseEntity, BotEntity $botEntity);

}