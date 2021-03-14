<?php

return [
    'fixture' => [
        'directory' => [
            'default' => '/fixtures',
        ],
    ],
    'migrate' => [
        'directory' => $_ENV['ELOQUENT_MIGRATIONS'] ?? [],
    ],
    /*'migrate' => [
        'directory' => [
            '/src/Modules/Partner/Domain/Migrations',
            '/src/Modules/Bridge/Domain/Migrations',
            '/vendor/znbundle/user/src/Domain/Migrations',
            '/vendor/znbundle/rbac/src/Domain/MigrationsFile',
            '/vendor/znbundle/queue/src/Domain/Migrations',
            '/vendor/znsandbox/sandbox/src/Log/Domain/Migrations',
        ],
    ],*/
];
