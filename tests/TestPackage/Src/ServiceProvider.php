<?php


namespace Iamdadmin\Yaslpt\Tests\TestPackage\Src;

use Closure;
use Iamdadmin\Yaslpt\Package;
use Iamdadmin\Yaslpt\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider
{
    public static ?Closure $configurePackageUsing = null;

    public function configurePackage(Package $package): void
    {
        $configClosure = self::$configurePackageUsing ?? function (Package $package) {
        };

        ($configClosure)($package);
    }
}
