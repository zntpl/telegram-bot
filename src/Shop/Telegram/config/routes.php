<?php

use ZnLib\Telegram\Domain\Actions\SendMessageAction;
use ZnLib\Telegram\Domain\Matchers\EqualOfPatternsMatcher;

return [
    [
        'matcher' => new EqualOfPatternsMatcher(['start']),
        'action' => new SendMessageAction('Привет! Я бот! Для помощи, наберите "help"'),
        'help' => 'echo - отразить сообщение',
    ],
];
