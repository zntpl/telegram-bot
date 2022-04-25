<?php

namespace App\TelegramClient;

use danog\MadelineProto\API;
use Illuminate\Container\Container;
use ZnCore\Base\Legacy\Yii\Helpers\FileHelper;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Application;

class Kernel
{

    private $container;

    public function init($container)
    {
        $this->container = $container;

//        $this->container = Container::getInstance();
        $this->bindContainer($this->container);
    }

    private function bindContainer(Container $container) {
        $container->bind(Application::class, Application::class, true);
        $this->bindApi($container);
        $container->bind(\ZnLib\Telegram\Domain\Services\ResponseService::class, \ZnLib\Telegram\Domain\Services\ResponseService::class, true);
//        $container->bind(\ZnLib\Telegram\Domain\Services\StateService::class, \ZnLib\Telegram\Domain\Services\StateService::class, true);
//        $container->bind(\ZnLib\Telegram\Domain\Services\UserService::class, \ZnLib\Telegram\Domain\Services\UserService::class, true);
        $container->bind(\ZnBundle\TalkBox\Domain\Interfaces\Repositories\TagRepositoryInterface::class, \ZnBundle\TalkBox\Domain\Repositories\Eloquent\TagRepository::class);
        $container->bind(\ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerRepositoryInterface::class, \ZnBundle\TalkBox\Domain\Repositories\Eloquent\AnswerRepository::class);
        $container->bind(\ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface::class, \ZnBundle\TalkBox\Domain\Repositories\Eloquent\AnswerTagRepository::class);
        $container->bind(\ZnBundle\TalkBox\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface::class, \ZnBundle\TalkBox\Domain\Repositories\Eloquent\AnswerOptionRepository::class);
//        $container->bind(\MyBundles\Top\Domain\Interfaces\Repositories\ShopRepositoryInterface::class, \MyBundles\Top\Domain\Repositories\Eloquent\ShopRepository::class);
        $container->bind(FilesystemAdapter::class, function () {
            return new FilesystemAdapter('app', \ZnCore\Base\Enums\Measure\TimeEnum::SECOND_PER_HOUR, $_ENV['CACHE_DIRECTORY']);
        }, true);
    }

    private function bindApi(Container $container) {
        $callback = function (): API {
            $sessionName = $_ENV['APP_ENV'] . '/session/madeline';
            FileHelper::createDirectory(__DIR__ . '/../../var/' . $_ENV['APP_ENV'] . '/session');
            $sessionFileName = __DIR__ . '/../../var/' . $sessionName;
            $sessionFileName = FileHelper::normalizePath($sessionFileName);
            $settings = include(__DIR__ . '/../../config/main-tlg-client.php');
            $api = new API($sessionFileName, $settings);
            $api->start();
            return $api;
        };
        $container->bind(API::class, $callback, true);
    }

}
