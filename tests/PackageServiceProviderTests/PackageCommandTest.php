<?php

use Iamdadmin\Yaeslpt\Package;
use Iamdadmin\Yaeslpt\Tests\TestClasses\TestCommand;

trait ConfigurePackageCommandTest
{
    public function configurePackage(Package $package)
    {
        $package
            ->name('laravel-package-tools')
            ->hasCommand(TestCommand::class);
    }
}

uses(ConfigurePackageCommandTest::class);

it('can execute a registered commands', function () {
    $this
        ->artisan('test-command')
        ->assertExitCode(0);
});
