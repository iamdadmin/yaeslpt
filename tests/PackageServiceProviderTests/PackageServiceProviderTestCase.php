<?php

namespace Iamdadmin\Yaeslpt\Tests\PackageServiceProviderTests;

use Iamdadmin\Yaeslpt\Package;
use Iamdadmin\Yaeslpt\Tests\TestCase;
use Iamdadmin\Yaeslpt\Tests\TestPackage\Src\ServiceProvider;
use Illuminate\Support\Facades\File;
use function Spatie\PestPluginTestTime\testTime;
use Symfony\Component\Finder\SplFileInfo;

abstract class PackageServiceProviderTestCase extends TestCase
{
    protected function setUp(): void
    {
        ServiceProvider::$configurePackageUsing = function (Package $package) {
            $this->configurePackage($package);
        };

        parent::setUp();

        testTime()->freeze('2020-01-01 00:00:00');

        $this->deletePublishedFiles();
    }

    abstract public function configurePackage(Package $package);

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function deletePublishedFiles(): self
    {
        $configPath = config_path('package-tools.php');

        if (file_exists($configPath)) {
            unlink($configPath);
        }


        collect(File::allFiles(database_path('migrations')))
            ->each(function (SplFileInfo $file) {
                unlink($file->getPathname());
            });

        collect(File::allFiles(app_path('Providers')))
            ->each(function (SplFileInfo $file) {
                unlink($file->getPathname());
            });

        return $this;
    }
}
