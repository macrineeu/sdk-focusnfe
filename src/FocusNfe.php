<?php

class FocusNfe
{
    private $isProduction = false;
    private $token;

    public function __construct(bool $isProduction, string $token)
    {
        $this->isProduction = $isProduction;
        $this->token = $token;
    }
}