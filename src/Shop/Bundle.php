<?php

namespace App\Shop;

use ZnCore\Base\Libs\App\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function console(): array
    {
        return [
            'App\Shop\Commands',
        ];
    }

    public function telegramRoutes(): array
    {
        return [
            __DIR__ . '/Telegram/config/routes.php',
        ];
    }
}
