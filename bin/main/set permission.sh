#!/bin/sh

cd ../..
sudo chmod -R a+rw var
sudo chown -R www-data:www-data var/sqlite
ls -l
