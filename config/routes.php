<?php

use ZnLib\Telegram\Domain\Actions\EchoAction;
use ZnLib\Telegram\Domain\Actions\GroupAction;
use ZnLib\Telegram\Domain\Actions\SendButtonAction;
use ZnLib\Telegram\Domain\Actions\SendMessageAction;
use ZnLib\Telegram\Domain\Matchers\EqualOfPatternsMatcher;
use ZnLib\Telegram\Domain\Matchers\GroupAndMatcher;

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

$routes = [


    [
        'matcher' => new EqualOfPatternsMatcher(['btn']),
        'action' => new SendButtonAction('111', [
            'keyboard' => [
                // первый ряд кнопок клавиатуры
                [
                    // первая кнопка первого ряда клавиатуры
                    [
                        "text" => date('H:i:s'), // "Button 1_1",
                    ],
                    // вторая кнопка первого ряда клавиатуры
                    [
                        "text" => "Button 1_2",
                    ]
                ],
            ]
        ]),
        'help' => '',
    ],
    [
        'matcher' => new EqualOfPatternsMatcher(['inline_keyboard']),
        'action' => new SendButtonAction('111', [
            'inline_keyboard' => [
                [
                    [
                        // текст кнопки
                        "text" => "Test",
                        // передаем значения для обработки кнопки разделенные знаком _
                        // первым идет метод который будет обрабатывать эту кнопку
                        // в данном примере это actionInlineButton
                        // вторым параметром идет значение 1234 для примера
                        // параметров может быть много все через заранее определенный
                        // знак в этом случае это нижнее подчеркивание
                        // общая длинна всей строки не должна превышать 64 байта (символа)
                        "callback_data" => "actionInlineButton_1234"
                    ],
                    [
                        // текст кнопки
                        "text" => "Test",
                        // ссылка на ресурс
                        "url" => "http://imakebots.ru"
                    ]
                ]
            ],
        ]),
        'help' => '',
    ],
    [
        'matcher' => new GroupAndMatcher([
            //new IsAdminMatcher,
            new EqualOfPatternsMatcher(['echo']),
        ]),
        'action' => new EchoAction(),
        'help' => 'echo - отразить сообщение',
    ],
    [
        'matcher' => new GroupAndMatcher([
            //new IsAdminMatcher,
            new EqualOfPatternsMatcher(['help']),
        ]),
        'action' => new GroupAction([
            new SendMessageAction(file_get_contents(__DIR__ . '/help.txt')),
            //new HelpAction($this),
        ]),
        'help' => 'help - вызов данной справки',
    ],

    /*[
        'matcher' => new AnyMatcher,
        'action' => new SendMessageAction('...'),
        'help' => '',
    ],*/

    /*[
        'matcher' => new GroupAndMatcher([
            new IsAdminMatcher,
            new EqualOfPatternsMatcher(['~']),
        ]),
        'action' => new GroupAction([
            new \ZnLib\Telegram\Domain\Actions\ConsoleCommandAction(),
        ]),
        'help' => '~ - выполнить команду в консоли',
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
    ],*/
];

$routes = array_merge($routes, include(__DIR__ . '/../src/Shop/Telegram/config/routes.php'));

return $routes;
