<?php

namespace App\Shop\Commands;

use Illuminate\Container\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnLib\Telegram\Domain\Services\BotService;
use ZnLib\Telegram\Domain\Services\ResponseService;

class SendMessageCommand extends Command
{

    protected static $defaultName = 'shop:send-message';

    protected function configure()
    {
        $this
            ->addArgument('chatId', InputArgument::REQUIRED, 'Who do you want to greet?')
            ->addArgument('text', InputArgument::REQUIRED, 'Who do you want to greet?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Send Message</>');
        $container = Container::getInstance();
        /** @var ResponseService $responseService */
        $responseService = $container->get(ResponseService::class);
        /** @var BotService $botService */
        $botService = $container->get(BotService::class);
//        $config = include __DIR__ . '/../../../config/main.php';
//        $botService->authByToken($config['telegram']['bot']['token']);
        $botService->authByToken($_ENV['TELEGRAM_BOT_TOKEN']);
        $responseService->sendMessage($input->getArgument('chatId'), $input->getArgument('text'));
        return Command::SUCCESS;
    }
}
