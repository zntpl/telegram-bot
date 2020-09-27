<?php


use App\Bootstrap\Kernel;
use Illuminate\Container\Container;
use ZnLib\Telegram\Api\Controllers\BotController;
use ZnLib\Telegram\Domain\Services\ResponseService;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */

require_once __DIR__ . '/../src/Bootstrap/autoload.php';
$rootPath = realpath(__DIR__ . '/..');
DotEnv::init($rootPath);
$container = Container::getInstance();

$kernel = new Kernel;
$kernel->init();

include __DIR__ . '/../config/container.php';
include __DIR__ . '/../config/bootstrap.php';

/** @var BotController $botController */
$botController = $container->get(BotController::class);

try {
    $botController->index();
} catch (Throwable $e) {
    /** @var ResponseService $responseService */
    $responseService = $container->get(ResponseService::class);
    $responseService->showError($e->getMessage());
}
