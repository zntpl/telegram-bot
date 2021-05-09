<?php

return [
    new \ZnCore\Base\Bundle(['all']),
    new \ZnCore\Base\Libs\I18Next\Bundle(['all']),
    new \App\Shop\Bundle(['all']),
    new \ZnLib\Telegram\Bundle(['all']),
    new \ZnBundle\Log\Bundle(['all']),
    new \ZnBundle\TalkBox\Bundle(['all']),
    new \App\Common\Bundle(['all']),

    //    new \ZnLib\Fixture\Bundle(['container', 'console']),
//    new \ZnLib\Db\Bundle(['container', 'console']),
//    new \ZnLib\Migration\Bundle(['container', 'console']),
    // new \ZnTool\Package\Bundle(['container', 'console']),
//    new \ZnTool\Phar\Bundle(['container', 'console']),
];
