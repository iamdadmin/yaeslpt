<?php

namespace Iamdadmin\Yaeslpt\Commands;

use Spatie\LaravelPackageTools\Commands\InstallCommand as BaseCommand;

class InstallCommand extends BaseCommand
{
    public function handle()
    {
        parent::handle();
    }

    public function publishModels(): self
    {
        return $this->publish('models');
    }

    public function publishSeeders(): self
    {
        return $this->publish('seeders');
    }
}
