<?php

use Iamdadmin\Yaeslpt\Package;
use Iamdadmin\Yaeslpt\Tests\TestClasses\FourthTestCommand;
use Iamdadmin\Yaeslpt\Tests\TestClasses\OtherTestCommand;
use Iamdadmin\Yaeslpt\Tests\TestClasses\TestCommand;
use Iamdadmin\Yaeslpt\Tests\TestClasses\ThirdTestCommand;

trait ConfigurePackageCommandsTest
{
    public function configurePackage(Package $package)
    {
        $package
            ->name('laravel-package-tools')
            ->hasCommand(TestCommand::class)
            ->hasCommands([OtherTestCommand::class])
            ->hasCommands(ThirdTestCommand::class, FourthTestCommand::class);
    }
}

uses(ConfigurePackageCommandsTest::class);

it('can execute a registered commands', function () {
    $this
        ->artisan('test-command')
        ->assertExitCode(0);

    $this
        ->artisan('other-test-command')
        ->assertExitCode(0);
});
