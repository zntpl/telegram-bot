@echo off

set rootDir="%~dp0/../.."
set eloquentBinDir="%rootDir%/vendor/zncore/db/bin"
set phpunit="vendor/phpunit/phpunit/phpunit"
set cacheDir="var/cache/test"

cd %rootDir%
if exist %cacheDir% rmdir /Q /S %cacheDir%

cd %eloquentBinDir%
php console_test db:migrate:up --withConfirm=0
php console_test db:fixture:import --withConfirm=0

cd %rootDir%
php %phpunit%
pause