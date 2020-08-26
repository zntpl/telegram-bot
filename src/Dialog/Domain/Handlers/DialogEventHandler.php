<?php

namespace App\Dialog\Domain\Handlers;

use App\Dialog\Domain\Actions\DataBaseAction;
use PhpBundle\TelegramClient\Actions\EchoAction;
use PhpBundle\TelegramClient\Actions\GroupAction;
use PhpBundle\TelegramClient\Actions\HelpAction;
use PhpBundle\TelegramClient\Actions\SendMessageAction;
use PhpBundle\TelegramClient\Actions\ShutdownServerAction;
use PhpBundle\TelegramClient\Handlers\BaseInputMessageEventHandler;
use PhpBundle\TelegramClient\Matchers\AnyMatcher;
use PhpBundle\TelegramClient\Matchers\EqualOfPatternsMatcher;
use PhpBundle\TelegramClient\Matchers\GroupAndMatcher;
use PhpBundle\TelegramClient\Matchers\IsAdminMatcher;
use App\Dialog\Domain\Actions\SearchAction;

class DialogEventHandler extends BaseInputMessageEventHandler
{

    public function definitions(): array
    {
        $simpleQuestions = [
            'что такое',
            'где искать',
            'найди мне',
            'где можно найти',
            'поищи',
            'где найти',
            'как найти',
            'где мне найти',
        ];
        return [
            [
                'matcher' => new GroupAndMatcher([
                    new IsAdminMatcher,
                    new EqualOfPatternsMatcher(['~']),
                ]),
                'action' => new GroupAction([
                    new \PhpBundle\TelegramClient\Actions\ConsoleCommandAction(),
                ]),
                'help' => '~ - выполнить команду в консоли',
            ],
            [
                'matcher' => new GroupAndMatcher([
                    new IsAdminMatcher,
                    new EqualOfPatternsMatcher(['echo']),
                ]),
                'action' => new GroupAction([
                    new EchoAction(),
                ]),
                'help' => 'echo - отразить сообщение',
            ],
            [
                'matcher' => new GroupAndMatcher([
                    new IsAdminMatcher,
                    new EqualOfPatternsMatcher(['sleep']),
                ]),
                'action' => new GroupAction([
                    new SendMessageAction('Buy! 👋'),
                    //new ShutdownHandlerAction($apiFactory, $this),
                    new ShutdownServerAction($this),
                ]),
                'help' => 'sleep - погрузить сервер в сон',
            ],
            [
                'matcher' => new GroupAndMatcher([
                    new EqualOfPatternsMatcher($simpleQuestions),
                ]),
                'action' => new SearchAction($simpleQuestions),
                'help' => 'Отвечает на вопросы: ' . implode('? ', $simpleQuestions) . '?',
            ],
            [
                'matcher' => new GroupAndMatcher([
                    new IsAdminMatcher,
                    new EqualOfPatternsMatcher(['help']),
                ]),
                'action' => new GroupAction([
                    //new SendMessageAction($apiFactory, file_get_contents(__DIR__ . '/../Resources/help.txt')),
                    new HelpAction($this),
                ]),
                'help' => 'help - вызов данной справки',
            ],
            [
                'matcher' => new AnyMatcher,
                'action' => new DataBaseAction(),
                'help' => '
Ифнобот реагирует, если понимает фразу. 
Он может ответить на распространенные вопросы, на пример: 
привет! 
сколько тебе лет? 
как дела?
Может понять, даже если вы написали слова с ошибками.
Перестановка слов местами мало на что влияет.',
            ],
        ];
    }

}