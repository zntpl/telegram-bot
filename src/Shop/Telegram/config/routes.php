<?php

use PhpBundle\TelegramClient\Actions\SendMessageAction;
use PhpBundle\TelegramClient\Matchers\EqualOfPatternsMatcher;

return [
    [
        'matcher' => new EqualOfPatternsMatcher(['start']),
        'action' => new SendMessageAction('Привет! Я бот! Для помощи, наберите "help"'),
        'help' => 'echo - отразить сообщение',
    ],
];
