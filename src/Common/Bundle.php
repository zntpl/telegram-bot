<?php

namespace App\Common;

use ZnCore\Base\Libs\App\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function container(): array
    {
        return [
            __DIR__ . '/../../vendor/zncore/base/src/Libs/App/container.php',
            __DIR__ . '/../../config/container.php',
        ];
    }

    public function telegramRoutes(): array
    {
        return [
            __DIR__ . '/../../config/routes.php',
        ];
    }
}
