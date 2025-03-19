<?php

namespace Macrineeu\SdkFocusnfe\Traits;

trait ServiceTrait
{
    public function empresas(bool $isProduction = false, string $token)
    {
        return new Empresas($token, $isProduction);
    }
}