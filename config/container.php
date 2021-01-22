<?php

use Illuminate\Container\Container;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Application;
use ZnBundle\TalkBox\Domain\Interfaces\Repositories\TagRepositoryInterface;
use ZnCore\Base\Enums\Measure\TimeEnum;
use ZnLib\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnLib\Telegram\Domain\Services\BotService;
use ZnLib\Telegram\Domain\Services\RequestService;
use ZnLib\Telegram\Domain\Services\ResponseService;
use ZnLib\Telegram\Domain\Services\RouteService;

/**
 * @var Application $application
 * @var Container $container
 */

$container->bind(BotService::class, BotService::class, true);
//$container->bind(TagRepositoryInterface::class, \ZnBundle\TalkBox\Domain\Repositories\Eloquent\TagRepository::class, true);
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

$definitions = [];
$definitions = array_merge($definitions, require(__DIR__ . '/../vendor/znbundle/talkbox/src/Domain/config/container.php'));
foreach ($definitions as $abstract => $concrete) {
    $container->bind($abstract, $concrete);
}

$container->bind(FilesystemAdapter::class, function () {
    return new FilesystemAdapter('app', TimeEnum::SECOND_PER_HOUR, $_ENV['CACHE_DIRECTORY']);
}, true);
