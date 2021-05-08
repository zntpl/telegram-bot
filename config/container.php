<?php

use ZnCore\Base\Helpers\EnvHelper;
use ZnLib\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnLib\Telegram\Domain\Repositories\Telegram\ResponseRepository as TelegramResponseRepository;
use ZnLib\Telegram\Domain\Repositories\Test\ResponseRepository as TestResponseRepository;
use ZnLib\Telegram\Domain\Services\BotService;
use ZnLib\Telegram\Domain\Services\RequestService;
use ZnLib\Telegram\Domain\Services\ResponseService;
use ZnLib\Telegram\Domain\Services\RouteService;

return [
    'definitions' => [],
    'singletons' => [
        BotService::class => BotService::class,
        RequestService::class, RequestService::class,
        ResponseService::class, ResponseService::class,
        RouteService::class => function () {
            /** @var RouteService $service */
            $service = new RouteService;
            $definitions = include(__DIR__ . '/../config/routes.php');
            $service->setDefinitions($definitions);
            return $service;
        },
        ResponseRepositoryInterface::class =>
            EnvHelper::isTest() ?
                TestResponseRepository::class :
                TelegramResponseRepository::class,
    ],
];
