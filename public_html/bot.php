<?php


use App\Bootstrap\Kernel;
use Illuminate\Container\Container;
use ZnLib\Telegram\Api\Controllers\BotController;
use ZnLib\Telegram\Domain\Services\ResponseService;
use ZnCore\Base\Libs\Env\DotEnvHelper;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */

require_once __DIR__ . '/../src/Bootstrap/autoload.php';
$rootPath = realpath(__DIR__ . '/..');
DotEnvHelper::init($rootPath);
$container = Container::getInstance();

$kernel = new Kernel;
$kernel->init();

include __DIR__ . '/../config/container.php';
include __DIR__ . '/../config/bootstrap.php';

$botConfig = include __DIR__ . '/../config/bot.php';

/** @var BotController $botController */
$botController = $container->get(BotController::class);

try {
    $botController->index();
} catch (Throwable $e) {
    /** @var ResponseService $responseService */
    $responseService = $container->get(ResponseService::class);
    $responseService->showError($e->getMessage());
}
