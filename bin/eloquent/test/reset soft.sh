#!/bin/sh
cd ../../../vendor/zncore/db/bin
php console_test db:migrate:down --withConfirm=0
# php console_test db:delete-all-tables --withConfirm=0
php console_test db:migrate:up --withConfirm=0
php console_test db:fixture:import --withConfirm=0