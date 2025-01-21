<?php

namespace Iamdadmin\Yaslpte;

use Illuminate\Support\Str;
use Spatie\LaravelPackageTools\PackageServiceProvider as BaseServiceProvider;

abstract class PackageServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->bootingPackage();

        $this->bootAssets();
        $this->bootCommands();
        $this->bootConsoleCommands();
        $this->bootConfigs();
        $this->bootInertia();
        $this->bootMigrations();
        $this->bootModels();
        $this->bootProviders();
        $this->bootRoutes();
        $this->bootSeeders();
        $this->bootTranslations();
        $this->bootViews();
        $this->bootViewComponents();
        $this->bootViewComposers();
        $this->bootViewSharedData();

        $this->packageBooted();

        return $this;
    }

    protected function bootModels()
    {
        if ($this->app->runningInConsole()) {
            foreach ($this->package->modelFileNames as $modelFileName) {
                $vendorModel = $this->package->basePath("/../app/Models/{$modelFileName}.php");
                $appModel = app_path('Models/'.Str::ucfirst($modelFileName).'.php');

                $this->publishes([$vendorModel => $appModel], "{$this->package->shortName()}-models");
            }
        }
    }

    protected function bootSeeders()
    {
        if ($this->app->runningInConsole()) {
            foreach ($this->package->seederFileNames as $seederFileName) {
                $vendorSeeder = $this->package->basePath("/../database/seeders/{$seederFileName}.php");
                $appSeeder = database_path('seeders/'.Str::studly($seederFileName).'Seeder.php');

                $this->publishes([$vendorSeeder => $appSeeder], "{$this->package->shortName()}-seeder");
            }
        }
    }
}
