<?php

return [
    'vendor' => [
        'downloadUrl' => 'https://tlg-assistant.000webhostapp.com/telegram-client/{version}/vendor.phar.gz',
        'version' => '0.0.11',
    ],
    'profiles' => [
        'vendor' => [
            'sourceDir' => realpath(__DIR__ . '/../vendor'),
            'outputFile' => realpath(__DIR__ . '/../vendor') . '/vendor.phar',
            'excludes' => [
                'regex:#\/(|tests|test|docs|doc|examples|example|benchmarks|benchmark|\.git|\.github)\/#iu',
                'regex:#(psalm.+|license|changelog|authors)#iu',
                '/composer.json',
                '/composer.lock',
                '/.gitignore',
                '/.gitmodules',
                '/.gitattributes',
                '/.travis.yml',
                '/Dockerfile',
                '.editorconfig',
                '.php_cs',
                'fixtures',
                'build.xml',
                '.scrutinizer.yml',
                //'/LICENSE',
                //'/CHANGELOG',
                //'/AUTHORS',
                '/Makefile',
                '/Vagrantfile',
                '/phpbench.json',
                '/appveyor.yml',
                '/phpstan.',
                '/phpunit.xml',
                '/amphp/http-client-cookies/res/',
                '/zendframework/',
                //'/danog/',
                //'/daverandom/',
                //'/php7fork/',
                '/tivie/',
                '/nesbot/',
                '/kelunik/',
                //'/league/',
                '/amphp/',
                '/symfony/translation/',
                '/symfony/translation-contracts/',
                //'/symfony/service-contracts/',
                '/php7lab/dev/',
                '/php7lab/test/',
                '/zndoc/rest-api/',
                //'/symfony/web-server-bundle',
                '/phpunit/',
                //'/codeception/',
                'regex:#[\s\S]+\.(neon|md|bat|dist|rar|zip|gz|phar|py|sh|bat|cmd|exe|h|c|example)#iu',
            ],
        ],
        'app' => [
            'sourceDir' => realpath(__DIR__ . '/../src'),
            'outputFile' => realpath(__DIR__ . '/../src') . '/app.phar',
            'excludes' => [
                '/src/Bootstrap/',
                '/src/Migrations/',
                '/src/Fixtures/',
            ],
        ],
    ],
];
