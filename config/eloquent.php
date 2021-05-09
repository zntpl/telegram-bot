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
];
