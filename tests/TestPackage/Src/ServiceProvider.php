<?php

namespace Iamdadmin\Yaeslpt\Tests\TestPackage\Src;

use Closure;
use Iamdadmin\Yaeslpt\Package;
use Iamdadmin\Yaeslpt\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider
{
    public static ?Closure $configurePackageUsing = null;

    public function configurePackage(Package $package): void
    {
        $configClosure = self::$configurePackageUsing ?? function (Package $package) {};

        ($configClosure)($package);
    }
}
