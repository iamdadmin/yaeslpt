<?php

use function PHPUnit\Framework\assertStringContainsString;
use function PHPUnit\Framework\assertStringNotContainsString;
use Iamdadmin\Yaeslpt\Commands\InstallCommand;
use Iamdadmin\Yaeslpt\Package;

trait ConfigureCopyAndRegisterServiceProviderInAppTest
{
    public function configurePackage(Package $package)
    {
        $package
            ->name('laravel-package-tools')
            ->hasConfigFile()
            ->publishesServiceProvider('MyPackageServiceProvider')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command->copyAndRegisterServiceProviderInApp();
            });
    }
}

/*
 * If we leave the published config file in,
 * all subsequent tests will fail
 */
function restoreAppConfigFile(): void
{
    $newContent = str_replace(
        'App\Providers\MyPackageServiceProvider::class,',
        '',
        file_get_contents(base_path('config/app.php'))
    );

    file_put_contents(base_path('config/app.php'), $newContent);
}

uses(ConfigureCopyAndRegisterServiceProviderInAppTest::class);

it('can copy and register the service provider in the app', function () {
    $this
        ->artisan('package-tools:install')
        ->assertSuccessful();

    if (intval(app()->version()) >= 11) {
        // This does not happen in L11 because of the different framework skeleton
        assertStringNotContainsString(
            "App\Providers\MyPackageServiceProvider::class",
            file_get_contents(base_path('config/app.php'))
        );
    } else {
        assertStringContainsString(
            "App\Providers\MyPackageServiceProvider::class",
            file_get_contents(base_path('config/app.php'))
        );
    }

    restoreAppConfigFile();
});
