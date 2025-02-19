<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

use Iamdadmin\Yaeslpt\Tests\PackageServiceProviderTests\PackageServiceProviderTestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

use function PHPUnit\Framework\assertTrue;

uses(PackageServiceProviderTestCase::class)->in('PackageServiceProviderTests');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

function assertMigrationPublished(string $fileName)
{
    $published = collect(File::allFiles(database_path('migrations')))
        ->contains(function (SplFileInfo $file) use ($fileName) {
            return Str::endsWith($file->getPathname(), $fileName);
        });

    assertTrue($published);
}
