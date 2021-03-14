<?php

use Illuminate\Container\Container;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;
use ZnCore\Base\Libs\App\Kernel;
use ZnCore\Base\Libs\App\Loaders\BundleLoader;
use ZnCore\Base\Libs\DotEnv\DotEnv;

require __DIR__ . '/../vendor/autoload.php';

DotEnv::init(__DIR__ . '/..');
$kernel = new Kernel('console');
$container = Container::getInstance();
$kernel->setContainer($container);
$bundles = [
    new \ZnLib\Fixture\Bundle(['container', 'console']),
    new \ZnLib\Db\Bundle(['container', 'console']),
    new \ZnLib\Migration\Bundle(['container', 'console']),
    new \ZnTool\Package\Bundle(['container', 'console']),
    new \ZnTool\Phar\Bundle(['container', 'console']),
//    new \App\Modules\Message\Bundle(['container', 'console']),
];
//$bundles = [];
$bundles = ArrayHelper::merge($bundles, include __DIR__ . '/../config/extra/bundle.php');
$bundleLoader = new BundleLoader($bundles, ['i18next', 'container', 'console', 'migration']);
$kernel->setLoader($bundleLoader);
$config = $kernel->loadAppConfig();





/*$container = Container::getInstance();
$configurator = new ConsoleApplicationConfigurator($container);
$configurator->registerContainerConfig(__DIR__ . '/../config/container.php');
$configurator->registerBundles([
    new \ZnLib\Fixture\Bundle(['container', 'console']),
    new \ZnLib\Db\Bundle(['container', 'console']),
    new \ZnLib\Migration\Bundle(['container', 'console']),
    new \ZnTool\Package\Bundle(['container', 'console']),
    new \ZnTool\Phar\Bundle(['container', 'console']),
]);

$application = new Application();
$configurator->loadConfig($application);
$application->run();*/
