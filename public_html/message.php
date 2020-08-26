<?php

use App\Bootstrap\Kernel;
use App\Client\Controllers\MessageController;
use PhpLab\Core\Libs\Env\DotEnvHelper;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */

require_once __DIR__ . '/../src/Bootstrap/autoload.php';
DotEnvHelper::init();
include __DIR__ . '/../config/bootstrap.php';

$container = Kernel::container();

/** @var MessageController $controller */
$controller = $container->get(MessageController::class);
$controller->all();
