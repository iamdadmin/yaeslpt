<?php

namespace Iamdadmin\Yaeslpt\Concerns\Package;

use Illuminate\Support\Str;

trait HasSeeders
{
    public array $seederFileNames = [];

    public function HasSeeders($seederFileName = null): static
    {
        $seederFileName ??= Str::studly($this->shortName().'Seeder');

        if (! is_array($seederFileName)) {
            $seederFileName = [$seederFileName];
        }

        $this->seederFileNames = $seederFileName;

        return $this;
    }
}
