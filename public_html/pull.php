<?php


use App\Bootstrap\Kernel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Tests\Server;
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

$config = include __DIR__ . '/../config/main.php';
$token = $config['telegram']['bot']['token'];


$url = "https://api.telegram.org/bot{$token}/getUpdates?" . http_build_query(['offset' => 592564580]);

$client = new Client();
//Server::enqueue([new Response(200, ['Content-Length' => 0])]);
$response = $client->get($url);
$content = $response->getBody()->getContents();
$data = json_decode($content, JSON_OBJECT_AS_ARRAY);
$updates = $data['result'];
//dd($updates);

foreach ($updates as $update) {
    $botUrl = "http://telegram-client.tpl/bot.php?token={$token}";
    try {
        $response = $client->post($botUrl, [
            GuzzleHttp\RequestOptions::JSON => $update
        ]);
    } catch (ServerException $e) {
        $response = $e->getResponse();
    }

    $content = $response->getBody()->getContents();
    dd($content);


    //$response = $client->get($botUrl);
    echo '121212';
    exit;
}


dd();

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
