<?php

use Iamdadmin\Yaeslpt\Package;

use function Spatie\PestPluginTestTime\testTime;

trait ConfigurePackageRouteTest
{
    public function configurePackage(Package $package)
    {
        testTime()->freeze('2020-01-01 00:00:00');

        $package
            ->name('laravel-package-tools')
            ->hasRoutes(['web', 'other']);
    }
}

uses(ConfigurePackageRouteTest::class);

it('can load the route', function () {
    $response = $this->get('my-route');

    $response->assertSeeText('my response');
});

it('can load multiple route', function () {
    $adminResponse = $this->get('other-route');

    $adminResponse->assertSeeText('other response');
});
