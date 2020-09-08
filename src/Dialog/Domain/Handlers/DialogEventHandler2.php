<?php

namespace App\Dialog\Domain\Handlers;

use ZnSandbox\Telegram\Handlers\BaseInputMessageEventHandler2;

class DialogEventHandler2 extends BaseInputMessageEventHandler2
{

    public function definitions(): array
    {
        return include(__DIR__ . '/../../../../config/routes.php');
    }
}