#!/bin/sh
cd ../../vendor

mkdir _dev
mkdir _orig

git clone "git@github.com:php7lab/core.git" "_dev/php7lab/core"
git clone "git@github.com:zntool/dev.git" "_dev/zntool/dev"
git clone "git@github.com:zncore/db.git" "_dev/zncore/db"

git clone "git@github.com:php7bundle/telegram-client.git" "_dev/php7bundle/telegram-client"

git clone "git@github.com:php7fork/danog_madelineproto.git" "_dev/php7fork/danog_madelineproto"
