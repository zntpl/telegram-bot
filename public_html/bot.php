<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Bootstrap\Kernel;
use App\Core\Controllers\BotController;
use App\Core\Services\ResponseService;
use ZnCore\Base\Libs\Env\DotEnvHelper;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */

require_once __DIR__ . '/../src/Bootstrap/autoload.php';
$rootPath = realpath(__DIR__ . '/..');
DotEnvHelper::init($rootPath);
include __DIR__ . '/../config/bootstrap.php';

$botConfig = include __DIR__ . '/../config/bot.php';
$container = Kernel::container();

/** @var BotController $botController */
$botController = $container->get(BotController::class);

try {
    $botController->index();
} catch (Throwable $e) {
    /** @var ResponseService $responseService */
    $responseService = $container->get(ResponseService::class);
    $responseService->showError($e->getMessage());
}
