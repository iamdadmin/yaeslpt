<?php

namespace Iamdadmin\Yaeslpt\Concerns\Package;

trait HasModels
{
    public array $modelFileNames = [];

    public function HasModelFile($modelFileName = null): static
    {
        $modelFileName ??= $this->shortName();

        if (! is_array($modelFileName)) {
            $modelFileName = [$modelFileName];
        }

        $this->modelFileNames = $modelFileName;

        return $this;
    }
}
