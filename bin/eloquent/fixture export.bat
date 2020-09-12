@echo off

set rootDir="%~dp0/../.."
set eloquentBinDir=%rootDir%/vendor/zncore/db/bin

cd %eloquentBinDir%
php console db:fixture:export
pause

REM use --withConfirm=0 for skip dialog
