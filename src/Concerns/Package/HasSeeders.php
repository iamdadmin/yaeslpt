<?php

namespace Iamdadmin\Yaeslpt\Concerns\Package;

trait HasSeeders
{
    public array $seederFileNames = [];

    public function HasSeederFile($seederFileName = null): static
    {
        $seederFileName ??= $this->shortName();

        if (! is_array($seederFileName)) {
            $seederFileName = [$seederFileName];
        }

        $this->seederFileNames = $seederFileName;

        return $this;
    }
}
