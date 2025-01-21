<?php

namespace Iamdadmin\Yaslpte;

use Iamdadmin\Yaslpte\Concerns\Package\HasModels;
use Iamdadmin\Yaslpte\Concerns\Package\HasSeeders;
use Spatie\LaravelPackageTools\Package as BasePackage;

class Package extends BasePackage
{
    use HasModels;
    use HasSeeders;
}
