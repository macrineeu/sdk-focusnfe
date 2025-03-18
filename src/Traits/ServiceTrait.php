<?php

namespace Macrineeu\SdkFocusnfe\Traits;

trait ServiceTrait
{
    public function empresas(bool $isProduction = false)
    {
        return new Empresas($isProduction);
    }
}