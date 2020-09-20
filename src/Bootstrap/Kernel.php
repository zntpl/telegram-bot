<?php

namespace App\Bootstrap;

use ZnLib\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnLib\Telegram\Domain\Repositories\Telegram\ResponseRepository;
use ZnLib\Telegram\Domain\Services\BotService;
use ZnLib\Telegram\Domain\Services\RequestService;
use ZnLib\Telegram\Domain\Services\ResponseService;
use danog\MadelineProto\API;
use Illuminate\Container\Container;
use ZnCore\Base\Legacy\Yii\Helpers\FileHelper;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Application;
use ZnLib\Telegram\Domain\Services\RouteService;

class Kernel
{

    /*private static $container;

    public static function container(): Container {
        return self::$container;
    }*/

    public function init()
    {
        //self::$container = Container::getInstance();
        //$this->bindContainer(self::$container);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    /*private function bindContainer(Container $container) {
        include __DIR__ . '/../../config/bootstrap.php';
    }

    private function bindApi(Container $container) {
        $callback = function (): API {
            $sessionName = $_ENV['APP_ENV'] . '/session/madeline';
            FileHelper::createDirectory(__DIR__ . '/../../var/' . $_ENV['APP_ENV'] . '/session');
            $sessionFileName = __DIR__ . '/../../var/' . $sessionName;
            $sessionFileName = FileHelper::normalizePath($sessionFileName);
            $settings = include(__DIR__ . '/../../config/main.php');
            $api = new API($sessionFileName, $settings);
            $api->start();
            return $api;
        };
        $container->bind(API::class, $callback, true);
    }*/

}
