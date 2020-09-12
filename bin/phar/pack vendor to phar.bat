@echo off

set rootDir="%~dp0/../.."
set binDir=%rootDir%/vendor/zntool/dev/bin

cd %binDir%
php console phar:pack:vendor
pause