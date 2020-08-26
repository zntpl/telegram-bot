<?php

use App\Bootstrap\Kernel;
use App\Client\Controllers\IndexController;
use PhpLab\Core\Libs\Env\DotEnvHelper;
use Psr\Container\ContainerInterface;

/** @var ContainerInterface $container */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../src/Bootstrap/autoload.php';
$rootPath = realpath(__DIR__ . '/..');
DotEnvHelper::init($rootPath);
include __DIR__ . '/../config/bootstrap.php';

$container = Kernel::container();

$controller = $container->get(IndexController::class);
$controller->form();
