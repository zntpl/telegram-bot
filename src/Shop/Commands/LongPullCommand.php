<?php

namespace App\Shop\Commands;

use GuzzleHttp\RequestOptions;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Bootstrap\Kernel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Tests\Server;
use Illuminate\Container\Container;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;
use ZnCore\Base\Libs\Store\StoreFile;
use ZnLib\Telegram\Api\Controllers\BotController;
use ZnLib\Telegram\Domain\Services\ResponseService;
use ZnCore\Base\Libs\DotEnv\DotEnv;
use Psr\Container\ContainerInterface;

class LongPullCommand extends Command
{

    protected static $defaultName = 'telegram:long-pull';

    /*protected function configure()
    {
        $this
            ->addArgument('chatId', InputArgument::REQUIRED, 'Who do you want to greet?')
            ->addArgument('text', InputArgument::REQUIRED, 'Who do you want to greet?');
    }*/

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Long pull</>');

        $config = include __DIR__ . '/../../../config/main.php';
        $stateFile = __DIR__ . '/../../../var/state.json';
        $storeFile = new StoreFile($stateFile);
        $lastId = $storeFile->load();

        $token = $config['telegram']['bot']['token'];

//dd($lastId);
        $url = "https://api.telegram.org/bot{$token}/getUpdates?" . http_build_query(['offset' => $lastId]);

        $client = new Client();
//Server::enqueue([new Response(200, ['Content-Length' => 0])]);
        $response = $client->get($url);
        $content = $response->getBody()->getContents();
        $data = json_decode($content, JSON_OBJECT_AS_ARRAY);
        $updates = $data['result'];

//        $updates = ArrayHelper::index($updates, 'update_id');
//        $ids = array_keys($updates);
//dd($lastUpdate['update_id']);

        foreach ($updates as $update) {
            $botUrl = "http://telegram-client.tpl/bot.php?token={$token}";
            try {
                $response = $client->post($botUrl, [
                    RequestOptions::JSON => $update
                ]);
            } catch (ServerException $e) {
                $response = $e->getResponse();
            }

//            $content = $response->getBody()->getContents();

            //dd($content);

        }

        $lastUpdate = ArrayHelper::last($updates);
        $storeFile->save($lastUpdate['update_id'] + 1);

        return Command::SUCCESS;
    }
}
