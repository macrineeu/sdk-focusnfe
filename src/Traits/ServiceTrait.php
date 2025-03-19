<?php

namespace Macrineeu\SdkFocusnfe\Traits;

trait ServiceTrait
{
    public function empresas(bool $sandbox = false, string $token)
    {
        return new Empresas($token, $sandbox);
    }
}