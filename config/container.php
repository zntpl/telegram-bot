<?php

use Illuminate\Container\Container;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Application;
use ZnCore\Base\Enums\Measure\TimeEnum;
use ZnLib\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnLib\Telegram\Domain\Services\BotService;
use ZnLib\Telegram\Domain\Services\RequestService;
use ZnLib\Telegram\Domain\Services\ResponseService;
use ZnLib\Telegram\Domain\Services\RouteService;

$container->bind(Application::class, Application::class, true);

$container->bind(BotService::class, BotService::class, true);
$container->bind(RequestService::class, RequestService::class, true);
$container->bind(ResponseService::class, ResponseService::class, true);
$container->bind(RouteService::class, function (Container $container) {
    /** @var RouteService $service */
    $service = new RouteService;
    $definitions = include(__DIR__ . '/../config/routes.php');
    $service->setDefinitions($definitions);
    return $service;
}, true);

if ($_ENV['APP_ENV'] == 'test') {
    $container->bind(ResponseRepositoryInterface::class, \ZnLib\Telegram\Domain\Repositories\Test\ResponseRepository::class);
} else {
    $container->bind(ResponseRepositoryInterface::class, \ZnLib\Telegram\Domain\Repositories\Telegram\ResponseRepository::class);
}

/*$container->bind(Application::class, Application::class, true);
$this->bindApi($container);*/

$container->bind(\App\Dialog\Domain\Interfaces\Repositories\TagRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\TagRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerTagRepository::class);
$container->bind(\App\Dialog\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface::class, \App\Dialog\Domain\Repositories\Eloquent\AnswerOptionRepository::class);

$container->bind(FilesystemAdapter::class, function () {
    return new FilesystemAdapter('app', TimeEnum::SECOND_PER_HOUR, $_ENV['CACHE_DIRECTORY']);
}, true);
