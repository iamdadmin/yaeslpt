<?php

use Iamdadmin\Yaslpt\Package;
use Iamdadmin\Yaslpt\Tests\TestClasses\FourthTestCommand;
use Iamdadmin\Yaslpt\Tests\TestClasses\OtherTestCommand;
use Iamdadmin\Yaslpt\Tests\TestClasses\TestCommand;
use Iamdadmin\Yaslpt\Tests\TestClasses\ThirdTestCommand;

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
