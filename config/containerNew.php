<?php

use Illuminate\Container\Container;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Application;
use ZnBundle\TalkBox\Domain\Interfaces\Repositories\TagRepositoryInterface;
use ZnCore\Base\Enums\Measure\TimeEnum;
use ZnCore\Domain\Interfaces\Libs\EntityManagerInterface;
use ZnCore\Domain\Libs\EntityManager;
use ZnLib\Db\Capsule\Manager;
use ZnLib\Db\Factories\ManagerFactory;
use ZnLib\Db\Orm\EloquentOrm;
use ZnLib\Telegram\Domain\Interfaces\Repositories\ResponseRepositoryInterface;
use ZnLib\Telegram\Domain\Services\BotService;
use ZnLib\Telegram\Domain\Services\RequestService;
use ZnLib\Telegram\Domain\Services\ResponseService;
use ZnLib\Telegram\Domain\Services\RouteService;

/**
 * @var Application $application
 * @var Container $container
 */

return [
    'definitions' => [],
    'singletons' => [
        BotService::class => BotService::class,
        RequestService::class, RequestService::class,
        ResponseService::class, ResponseService::class,
        Manager::class => function () {
            $manager = ManagerFactory::createManagerFromEnv();
            return $manager;
        },
        EntityManagerInterface::class => function (ContainerInterface $container) {
            $em = EntityManager::getInstance($container);
            $eloquentOrm = $container->get(EloquentOrm::class);
            $em->addOrm($eloquentOrm);
            return $em;
        },
        RouteService::class => function (Container $container) {
            /** @var RouteService $service */
            $service = new RouteService;
            $definitions = include(__DIR__ . '/../config/routes.php');
            $service->setDefinitions($definitions);
            return $service;
        },
        ResponseRepositoryInterface::class => $_ENV['APP_ENV'] == 'test'
            ? \ZnLib\Telegram\Domain\Repositories\Test\ResponseRepository::class
            : \ZnLib\Telegram\Domain\Repositories\Telegram\ResponseRepository::class,
        FilesystemAdapter::class => function () {
            return new FilesystemAdapter('app', TimeEnum::SECOND_PER_HOUR, $_ENV['CACHE_DIRECTORY']);
        },
    ],
];
