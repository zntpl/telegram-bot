<?php

use ZnSandbox\Telegram\Actions\SendMessageAction;
use ZnSandbox\Telegram\Matchers\EqualOfPatternsMatcher;

return [
    [
        'matcher' => new EqualOfPatternsMatcher(['start']),
        'action' => new SendMessageAction('Привет! Я бот! Для помощи, наберите "help"'),
        'help' => 'echo - отразить сообщение',
    ],
];
