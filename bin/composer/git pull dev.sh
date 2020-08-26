#!/bin/sh
cd ../../vendor

mkdir _dev
mkdir _orig

git clone "git@github.com:php7lab/core.git" "_dev/php7lab/core"
git clone "git@github.com:php7lab/dev.git" "_dev/php7lab/dev"
git clone "git@github.com:php7lab/eloquent.git" "_dev/php7lab/eloquent"

git clone "git@github.com:php7bundle/telegram-client.git" "_dev/php7bundle/telegram-client"

git clone "git@github.com:php7fork/danog_madelineproto.git" "_dev/php7fork/danog_madelineproto"
