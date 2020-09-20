<?php

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

$container->bind(Application::class, Application::class, true);

$container->bind(BotService::class, BotService::class, true);
$container->bind(RequestService::class, RequestService::class, true);
$container->bind(ResponseService::class, ResponseService::class, true);
$container->bind(RouteService::class, function (Container $container) {
    /** @var RouteService $service */
    //$service = $container->get(RouteService::class);
    $service = new RouteService;
    $definitions = include(__DIR__ . '/../config/routes.php');
    $service->setDefinitions($definitions);
    return $service;
}, true);
//$container->bind(ResponseRepositoryInterface::class, ResponseRepository::class);
//$container->bind(ResponseRepositoryInterface::class, \ZnLib\Telegram\Domain\Repositories\Test\ResponseRepository::class);
$container->bind(ResponseRepositoryInterface::class, \ZnLib\Telegram\Domain\Repositories\Telegram\ResponseRepository::class);

/*$container->bind(Application::class, Application::class, true);
$this->bindApi($container);
$container->bind(\ZnLib\Telegram\Domain\Services\ResponseService::class, \ZnLib\Telegram\Domain\Services\ResponseService::class, true);
$container->bind(\ZnLib\Telegram\Domain\Services\StateService::class, \ZnLib\Telegram\Domain\Services\StateService::class, true);
$container->bind(\ZnLib\Telegram\Domain\Services\UserService::class, \ZnLib\Telegram\Domain\Services\UserService::class, true);

$container->bind(\MyBundles\Top\Domain\Interfaces\Repositories\ShopRepositoryInterface::class, \MyBundles\Top\Domain\Repositories\Eloquent\ShopRepository::class);
*/

$container->bind(\App\Dialog\Domain\Interfaces\Repositories\TagRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\TagRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerTagRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerOptionRepository::class);

$container->bind(FilesystemAdapter::class, function () {
    return new FilesystemAdapter('app', \ZnCore\Base\Enums\Measure\TimeEnum::SECOND_PER_HOUR, $_ENV['CACHE_DIRECTORY']);
}, true);
