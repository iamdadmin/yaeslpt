# YAESLPT (pronounced: YAY-SLIPPED): Yet Another Extension for Spatie Laravel-Package-Tools

[![Latest Version on Packagist](https://img.shields.io/packagist/v/iamdadmin/yaeslpt.svg?style=flat-square)](https://packagist.org/packages/iamdadmin/yaeslpt)
![Tests](https://github.com/iamdadmin/yaeslpt/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/iamdadmin/yaeslpt.svg?style=flat-square)](https://packagist.org/packages/iamdadmin/yaeslpt)

This package contains extensions for Spatie's excellent `Laravel-Package-Tools`. It extends that package's `PackageServiceProvider` with a couple of features I deemed important for me, but Spatie had previously elected not to include, having checked their repository discussions!

Here's an example of how it can be used; it's essentially a drop-in replacement for Laravel-Package-Tools, with some extra options on $package.

```php
use Iamdadmin\Yaeslpt\PackageServiceProvider;
use Iamdadmin\Yaeslpt\Package;
use MyPackage\ViewComponents\Alert;
use Iamdadmin\Yaeslpt\Commands\InstallCommand;

class YourPackageServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('your-package-name')
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponent('spatie', Alert::class)
            ->hasViewComposer('*', MyViewComposer::class)
            ->sharesDataWithAllViews('downloads', 3)
            ->hasTranslations()
            ->hasModels()
            ->hasSeeders()
            ->hasAssets()
            ->publishesServiceProvider('MyProviderName')
            ->hasRoute('web')
            ->hasMigration('create_package_tables')
            ->hasCommand(YourCoolPackageCommand::class)
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishAssets()
                    ->publishMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub();
            });
    }
}
```

Under the hood it will do the necessary work to register the necessary things and make all sorts of files publishable.

## Getting started

I would suggest using [our package-skeleton repo](https://github.com/iamdadmin/yaespsl) to start your package. This is also a fork of the upstream Spatie template, and will boilerplate everything you need.

## Extensions included in this package

### Trait: HasModels

To Publish one or more Models, in the package root create the folder "app" and then "Models" inside it. Follow the Laravel case naming conventions.

Inside that folder place your model.php file.

Example 1. Assume a default model name, based on 'your-package-name'. At this point it is case SENSITIVE and assumes lowercase, but will publish in `Str::studly` format to align with conventions.

```php
$package
    ->name('your-package-name')
    ->hasModels();
```

* Package
 * app
  * app/Models
   * your-package-name.php
 * src
 * tests

Example 2. Provide a custom model name. This is case SENSITIVE and will assume whatever case you provide, but will publish in `Str::studly` format to align with conventions.

```php
$package
    ->name('your-package-name')
    ->hasModels('MyModelFile');
```

* Package
 * app
  * app/Models
   * MyModelFile.php
 * src
 * tests

Example 3. Provide multiple models. Again, this is case SENSITIVE, but will publish in `Str::studly` format to align with conventions. You will need to pass *all* models including the default one if you're using it.

```php
$package
    ->name('your-package-name')
    ->hasModels(
        [
            'your-package-name',
            'MyModelFile',
            'MySecondModelFile',
            'alowercasemodelfile',
        ]);
```

* Package
 * app
  * app/Models
   * your-package-name.php
   * MyModelFile.php
   * MySecondModelFile.php
   * alowercasemodelfile.php
 * src
 * tests

Using this method will make the model(s) publishable. Users of your package will be able to publish with the following command.

```bash
php artisan vendor:publish --tag=your-package-name-models
```

### Trait: HasSeeders

To Publish one or more Models, in the package root create the folder "app" and then "Models" inside it. Follow the Laravel case naming conventions.

Inside that folder place your model.php file.

Example 1. Assume a default model name, based on 'your-package-name'. At this point it is case SENSITIVE and assumes lowercase, but will publish in `Str::studly` format to align with conventions.

```php
$package
    ->name('your-package-name')
    ->hasModels();
```

* Package
 * app
  * app/Models
   * your-package-name.php
 * src
 * tests

Example 2. Provide a custom model name. This is case SENSITIVE and will assume whatever case you provide, but will publish in `Str::studly` format to align with conventions.

```php
$package
    ->name('your-package-name')
    ->hasModels('MyModelFile');
```

* Package
 * app
  * app/Models
   * MyModelFile.php
 * src
 * tests

Example 3. Provide multiple models. Again, this is case SENSITIVE, but will publish in `Str::studly` format to align with conventions. You will need to pass *all* models including the default one if you're using it.

```php
$package
    ->name('your-package-name')
    ->hasModels(
        [
            'your-package-name',
            'MyModelFile',
            'MySecondModelFile',
            'alowercasemodelfile',
        ]);
```

* Package
 * app
  * app/Models
   * your-package-name.php
   * MyModelFile.php
   * MySecondModelFile.php
   * alowercasemodelfile.php
 * src
 * tests

Using this method will make the model(s) publishable. Users of your package will be able to publish with the following command.

```bash
php artisan vendor:publish --tag=your-package-name-models
```

### Future extensions

I expect I will add more extensions in the future as I run into them and need to add them.

## YAESLPT Governance

### Testing

```bash
composer test
```

### License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Have more questions?

If you are here, you know what this is and why you might need it. There's no additional instructions required on top of the excellent and widely available online learning for [Spatie Laravel-Package-Tools](https://github.com/spatie/laravel-package-tools/), where I suggest you start.

If you have any problems with getting your Seeders or Models published though, please [open an issue](https://github.com/iamdadmin/yaeslpt/issues/new/choose).


## Support Spatie's excellent work if you like these extensions

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-package-tools.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-package-tools)

Spatie and co invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can
support them by [buying one of our paid products](https://spatie.be/open-source/support-us).

Spatie and co highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
You'll find their address on [our contact page](https://spatie.be/about-us). They publish all received postcards
on [our virtual postcard wall](https://spatie.be/open-source/postcards).