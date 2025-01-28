<?php

namespace Iamdadmin\Yaeslpt;

use Iamdadmin\Yaeslpt\Commands\InstallCommand;
use Iamdadmin\Yaeslpt\Concerns\Package\HasModels;
use Iamdadmin\Yaeslpt\Concerns\Package\HasSeeders;
use Spatie\LaravelPackageTools\Package as BasePackage;

class Package extends BasePackage
{
    use HasModels;
    use HasSeeders;

    public function hasInstallCommand($callable): static
    {
        $installCommand = new InstallCommand($this);

        $callable($installCommand);

        $this->consoleCommands[] = $installCommand;

        return $this;
    }
}
