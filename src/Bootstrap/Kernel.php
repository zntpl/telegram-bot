<?php

namespace App\Bootstrap;

use App\Core\Interfaces\Repositories\ResponseRepositoryInterface;
use App\Core\Repositories\Telegram\ResponseRepository;
use App\Core\Services\BotService;
use App\Core\Services\RequestService;
use App\Core\Services\ResponseService;
use danog\MadelineProto\API;
use Illuminate\Container\Container;
use PhpLab\Core\Legacy\Yii\Helpers\FileHelper;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Application;

class Kernel
{

    private static $container;

    public static function container(): Container {
        return self::$container;
    }

    public function init()
    {
        self::$container = Container::getInstance();
        $this->bindContainer(self::$container);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    private function bindContainer(Container $container) {
        $container->bind(Application::class, Application::class, true);

        $container->bind(BotService::class, BotService::class, true);
        $container->bind(RequestService::class, RequestService::class, true);
        $container->bind(ResponseService::class, ResponseService::class, true);
        //$container->bind(ResponseRepositoryInterface::class, ResponseRepository::class);
        //$container->bind(ResponseRepositoryInterface::class, \App\Core\Repositories\Test\ResponseRepository::class);
        $container->bind(ResponseRepositoryInterface::class, \App\Core\Repositories\Telegram\ResponseRepository::class);

        /*$container->bind(Application::class, Application::class, true);
        $this->bindApi($container);
        $container->bind(\PhpBundle\TelegramClient\Services\ResponseService::class, \PhpBundle\TelegramClient\Services\ResponseService::class, true);
        $container->bind(\PhpBundle\TelegramClient\Services\StateService::class, \PhpBundle\TelegramClient\Services\StateService::class, true);
        $container->bind(\PhpBundle\TelegramClient\Services\UserService::class, \PhpBundle\TelegramClient\Services\UserService::class, true);

        $container->bind(\MyBundles\Top\Domain\Interfaces\Repositories\ShopRepositoryInterface::class, \MyBundles\Top\Domain\Repositories\Eloquent\ShopRepository::class);
        */

        $container->bind(\App\Dialog\Domain\Interfaces\Repositories\TagRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\TagRepository::class);
        $container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerRepository::class);
        $container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerTagRepository::class);
        $container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerOptionRepository::class);

        $container->bind(FilesystemAdapter::class, function () {
            return new FilesystemAdapter('app', \PhpLab\Core\Enums\Measure\TimeEnum::SECOND_PER_HOUR, $_ENV['CACHE_DIRECTORY']);
        }, true);
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
    }

}
