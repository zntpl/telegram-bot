<?php

return [

    new \App\Shop\Bundle(['i18next', 'container', 'console', 'migration']),
    new \ZnLib\Telegram\Bundle(['i18next', 'container', 'console', 'migration']),
    new \ZnBundle\Log\Bundle(['i18next', 'container', 'console', 'migration']),
    new \ZnBundle\TalkBox\Bundle(['i18next', 'container', 'console', 'migration']),
    new \App\Application\Bundle(['i18next', 'container', 'console', 'migration']),

    //    new \ZnLib\Fixture\Bundle(['container', 'console']),
//    new \ZnLib\Db\Bundle(['container', 'console']),
//    new \ZnLib\Migration\Bundle(['container', 'console']),
    // new \ZnTool\Package\Bundle(['container', 'console']),
//    new \ZnTool\Phar\Bundle(['container', 'console']),
];
