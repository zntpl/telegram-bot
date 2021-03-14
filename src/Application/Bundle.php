<?php

namespace App\Application;

use ZnCore\Base\Libs\App\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function i18next(): array
    {
        return [
//            'app' => 'common/i18next/__lng__/__ns__.json',
//            'web' => 'vendor/znyii/web/src/i18next/__lng__/__ns__.json',
            'symfony' => 'vendor/zncore/base/src/Libs/I18Next/SymfonyTranslation/i18next/__lng__/__ns__.json',
            'core' => 'vendor/zncore/base/src/i18next/__lng__/__ns__.json',
        ];
    }

    public function console(): array
    {
        return [
            //'MyBundles\Top\Commands',
        ];
    }

    public function migration(): array
    {
        return [
//            '/src/Modules/Partner/Domain/Migrations',
//            '/src/Modules/Bridge/Domain/Migrations',
//            '/vendor/znbundle/user/src/Domain/Migrations',
//            '/vendor/znbundle/rbac/src/Domain/MigrationsFile',
//            '/vendor/znbundle/queue/src/Domain/Migrations',
//            '/vendor/znsandbox/sandbox/src/Log/Domain/Migrations',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/../../config/container.php',
            //__DIR__ . '/../../vendor/znbundle/talkbox/src/Domain/config/container.php',

            //$configurator->registerContainerConfig(__DIR__ . '/../vendor/znbundle/log/src/Domain/config/container.php');


//            [__DIR__ . '/../../vendor/znbundle/notify/src/Domain/config/container.php', 'singletons'],
//            [__DIR__ . '/../../vendor/zncrypt/jwt/src/Domain/config/container.php', 'singletons'],
//            [__DIR__ . '/../../vendor/zncrypt/base/src/Domain/config/container.php', 'singletons'],
//            [__DIR__ . '/../../vendor/zncore/base/src/Libs/I18Next/config/container.php', 'singletons'],
//            __DIR__ . '/../../common/config/container.php',
        ];
    }
}
