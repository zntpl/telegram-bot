@echo off

set rootDir="%~dp0/../../.."
set eloquentBinDir=%rootDir%/vendor/zncore/db/bin

cd %eloquentBinDir%
php console_test db:fixture:export
pause

REM use --withConfirm=0 for skip dialog
