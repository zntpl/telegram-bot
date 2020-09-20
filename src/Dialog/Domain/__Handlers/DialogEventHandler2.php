<?php

namespace App\Dialog\Domain\__Handlers;

use ZnLib\Telegram\Domain\Handlers\BaseInputMessageEventHandler2;

class ____DialogEventHandler2 extends BaseInputMessageEventHandler2
{

    public function definitions(): array
    {
        return include(__DIR__ . '/../../../../config/routes.php');
    }
}