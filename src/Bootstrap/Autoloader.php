<?php

namespace App\Bootstrap;

use ZnCore\Base\Helpers\ComposerHelper;

class Autoloader
{

    public static function bootstrapApplication(string $rootDir)
    {
        $rootDir = realpath($rootDir);
        $pharFileName = 'phar://' . $rootDir . '/src/app.phar';
        if(file_exists($pharFileName)) {
            ComposerHelper::register('App', $pharFileName);
        } else {
            ComposerHelper::register('App', $rootDir . '/src');
        }
    }

    public static function bootstrapVendor(string $rootDir)
    {
        $rootDir = realpath($rootDir);
        $vendorDir = $rootDir . '/vendor';
        $isIncluded = self::includeVendorAutoload($vendorDir);
        if ( ! $isIncluded) {
            throw new \Exception('Vendor not found!');
            /*$isDownloaded = self::downloadVendor($vendorDir);
            if ($isDownloaded) {
                self::includeVendorAutoload($vendorDir);
            } else {
                exit('Vendor not loaded!');
            }*/
        }
    }

    /*private static function downloadVendor(string $vendorDir): bool
    {
        require_once __DIR__ . '/../Bootstrap/VendorDownloader.php';
        $isDownloaded = VendorDownloader::downloadPhar($vendorDir);
        return $isDownloaded;
    }*/

    private static function includeVendorAutoload(string $vendorDir): bool
    {
        if (self::load($vendorDir . '/autoload.php')) {
            return true;
        }
        $pharFile = $vendorDir . '/vendor.phar';
        if( ! is_file($pharFile)) {
            $pharConfig = include __DIR__ . '/../../config/phar.php';
            $pharFile = $pharConfig['profiles']['vendor']['outputFile'];
        }
        $pharPath = 'phar://' . $pharFile;
        if (self::load($pharPath . '/autoload.php')) {
            return true;
        }
        if (self::load($pharPath . '.gz/autoload.php')) {
            return true;
        }
        return false;
    }

    private static function load($fileName): bool
    {
        if (file_exists($fileName)) {
            require_once($fileName);
            return true;
        }
        return false;
    }

}
