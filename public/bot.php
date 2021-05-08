<?php

use Illuminate\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use ZnCore\Base\Helpers\ComposerHelper;
use ZnCore\Base\Helpers\EnvHelper;
use ZnCore\Base\Libs\App\Kernel;
use ZnCore\Base\Libs\App\Loaders\ContainerConfigLoader;
use ZnCore\Base\Libs\App\Loaders\RoutingConfigLoader;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use ZnLib\Rest\Helpers\CorsHelper;
use ZnLib\Telegram\Api\Controllers\BotController;
use ZnLib\Telegram\Domain\Services\ResponseService;
use ZnLib\Web\Symfony4\MicroApp\MicroApp;

require __DIR__ . '/../vendor/autoload.php';

DotEnv::init(__DIR__ . '/..');
CorsHelper::autoload();
EnvHelper::setErrorVisibleFromEnv();
ComposerHelper::register('App', __DIR__ . '/../src');

$container = Container::getInstance();
$kernel = new Kernel('telegram');
$kernel->setContainer($container);
//$kernel->setLoader(new ContainerConfigLoader(__DIR__ . '/../config/extra/importContainer.php'));
/*$kernel->setLoader(new RoutingConfigLoader([
    __DIR__ . '/../vendor/znlib/rpc/src/Symfony4/Web/config/routing.php'
]));*/
$mainConfig = $kernel->loadAppConfig();

//dd($mainConfig);

/** @var BotController $botController */
$botController = $container->get(BotController::class);

try {
    $botController->index();
} catch (Throwable $e) {
    /** @var ResponseService $responseService */
    $responseService = $container->get(ResponseService::class);
    $responseService->showError($e->getMessage());
}

/*$app = new MicroApp($container, $mainConfig['routeCollection']);
$request = Request::createFromGlobals();
$response = $app->run($request);
$response->send();*/











//use App\Bootstrap\Kernel;
//use Illuminate\Container\Container;
//use ZnLib\Telegram\Api\Controllers\BotController;
//use ZnLib\Telegram\Domain\Services\ResponseService;
//use ZnCore\Base\Libs\DotEnv\DotEnv;
//use Psr\Container\ContainerInterface;
//
///** @var ContainerInterface $container */
//
//require_once __DIR__ . '/../src/Bootstrap/autoload.php';
//$rootPath = realpath(__DIR__ . '/..');
//DotEnv::init($rootPath);
//$container = Container::getInstance();
//
//$kernel = new Kernel;
//$kernel->init();
//
//include __DIR__ . '/../config/container.php';
//include __DIR__ . '/../config/bootstrap.php';
//
///** @var BotController $botController */
//$botController = $container->get(BotController::class);
//
//try {
//    $botController->index();
//} catch (Throwable $e) {
//    /** @var ResponseService $responseService */
//    $responseService = $container->get(ResponseService::class);
//    $responseService->showError($e->getMessage());
//}
