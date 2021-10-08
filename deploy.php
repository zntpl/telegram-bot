<?php

namespace Deployer;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/zntool/deployer/src/config/bootstrap.php';
//require_once __DIR__ . '/vendor/deployer/deployer/recipe/common.php';

require_once __DIR__ . '/vendor/zntool/deployer/src/recipe/app/deploy.php';
require_once __DIR__ . '/vendor/zntool/deployer/src/recipe/app/settings.php';
require_once __DIR__ . '/vendor/zntool/deployer/src/recipe/app/upgrade_vendor.php';
require_once __DIR__ . '/vendor/zntool/deployer/src/recipe/tools.php';
//requireLibs(__DIR__ . '/src/Deployer/recipe');

App::init();
App::initVarsFromArray([
//    'repository' => 'git@gitlab.com:php7tpl/telegram-client.git',
//    'branch' => 'clean',
    'show_detail' => 0,
//    'public_directory' => 'public_html',

    'release_public_path' => '{{release_path}}/public_html',
    'deploy_public_path' => '{{deploy_path}}/public_html',

    'keep_releases' => 3,
    'allow_anonymous_stats' => 1,
    'git_tty' => 1,
    'application' => 'mysite',
    'default_stage' => 'staging',
    'ssh_key_list' => [
        [
            'name' => 'my-github',
            'host' => 'github.com',
        ],
        [
            'name' => 'my-gitlab',
            'host' => 'gitlab.com',
        ],
    ],
]);
